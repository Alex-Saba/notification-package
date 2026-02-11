<?php

namespace TemplateGenerator;

use Illuminate\Support\ServiceProvider;
use TemplateGenerator\Channels\LogChannel;
use TemplateGenerator\Channels\MailChannel;
use TemplateGenerator\Contracts\NotificationSenderContract;
use TemplateGenerator\Contracts\TemplateGeneratorContract;
use TemplateGenerator\Services\NotificationSender;
use TemplateGenerator\Services\TemplateGenerator;

class TemplateGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TemplateGeneratorContract::class, TemplateGenerator::class);
        $this->app->singleton(MailChannel::class, MailChannel::class);
        $this->app->singleton(LogChannel::class, LogChannel::class);
        $this->app->singleton(NotificationSenderContract::class, NotificationSender::class);

        $this->mergeConfigFrom(__DIR__ . '/../config/notification-package.php', 'notification-package');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/notification-package.php' => config_path('notification-package.php'),
        ], 'notification-package-config');
    }
}
