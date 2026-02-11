<?php

namespace TemplateGenerator\Events;

class NotificationSent
{
    public function __construct(
        public readonly string $channel,
        public readonly string $to,
        public readonly string $subject,
        public readonly string $filename
    ) {}
}
