<?php

namespace TemplateGenerator\Contracts;

interface NotificationSenderContract
{
    /**
     * Send a notification with a generated PDF attachment.
     *
     * Expected payload keys:
     * - to: string (email or channel target)
     * - subject: string
     * - template_id: int
     * - entities: array (model FQCN => id)
     * - channels: array (optional, defaults from config)
     */
    public function sendTemplatePdf(array $payload): void;
}
