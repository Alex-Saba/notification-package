<?php

namespace TemplateGenerator\Channels;

use Illuminate\Support\Facades\Log;

class LogChannel
{
    public function send(string $to, string $subject, string $pdfBinary, string $filename): void
    {
        Log::info('Notification (log channel)', [
            'to' => $to,
            'subject' => $subject,
            'filename' => $filename,
            'pdf_bytes' => strlen($pdfBinary),
        ]);
    }
}
