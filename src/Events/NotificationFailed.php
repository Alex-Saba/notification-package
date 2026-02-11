<?php

namespace TemplateGenerator\Events;

class NotificationFailed
{
    public function __construct(
        public readonly string $channel,
        public readonly string $to,
        public readonly string $subject,
        public readonly string $error
    ) {}
}
