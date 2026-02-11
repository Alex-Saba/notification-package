<?php

namespace TemplateGenerator;

use Illuminate\Support\ServiceProvider;
use TemplateGenerator\Contracts\TemplateGeneratorContract;
use TemplateGenerator\Services\TemplateGenerator;

class TemplateGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TemplateGeneratorContract::class, TemplateGenerator::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
