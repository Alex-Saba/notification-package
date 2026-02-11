<?php

namespace TemplateGenerator\Channels;

use Illuminate\Support\Facades\Mail;

class MailChannel
{
    public function send(string $to, string $subject, string $pdfBinary, string $filename): void
    {
        Mail::raw('Veuillez trouver le document en piece jointe.', function ($message) use ($to, $subject, $pdfBinary, $filename) {
            $message->to($to)
                ->subject($subject)
                ->attachData($pdfBinary, $filename, [
                    'mime' => 'application/pdf',
                ]);
        });
    }
}
