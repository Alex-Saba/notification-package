<?php

namespace TemplateGenerator\Services;

use Illuminate\Support\Arr;
use TemplateGenerator\Channels\LogChannel;
use TemplateGenerator\Channels\MailChannel;
use TemplateGenerator\Contracts\NotificationSenderContract;
use TemplateGenerator\Contracts\TemplateGeneratorContract;
use TemplateGenerator\Events\NotificationFailed;
use TemplateGenerator\Events\NotificationSent;
use InvalidArgumentException;

class NotificationSender implements NotificationSenderContract
{
    public function __construct(
        protected TemplateGeneratorContract $templateGenerator,
        protected MailChannel $mailChannel,
        protected LogChannel $logChannel
    ) {}

    public function sendTemplatePdf(array $payload): void
    {
        $to = Arr::get($payload, 'to');
        $subject = Arr::get($payload, 'subject', 'Document');
        $templateId = Arr::get($payload, 'template_id');
        $entities = Arr::get($payload, 'entities', []);
        $channels = Arr::get($payload, 'channels', config('notification-package.channels', ['mail']));

        if (!$to || !$templateId) {
            throw new InvalidArgumentException('Payload must include "to" and "template_id".');
        }

        $pdfBinary = $this->templateGenerator->generatePdf((int) $templateId, $entities);
        $filename = Arr::get($payload, 'filename', 'document.pdf');

        foreach ($channels as $channel) {
            try {
                if ($channel === 'mail') {
                    $this->mailChannel->send($to, $subject, $pdfBinary, $filename);
                } elseif ($channel === 'log') {
                    $this->logChannel->send($to, $subject, $pdfBinary, $filename);
                }

                event(new NotificationSent($channel, $to, $subject, $filename));
            } catch (\Throwable $th) {
                event(new NotificationFailed($channel, $to, $subject, $th->getMessage()));
                throw $th;
            }
        }
    }
}
