# TemplateGenerator

Laravel package that generates PDF documents from stored templates and entity data.

## Installation (VCS repo)

```json
"repositories": [
  { "type": "vcs", "url": "https://github.com/Alex-Saba/notification-package" }
],
"require": {
  "saba/templategenerator": "dev-main"
}
```

```bash
composer update
php artisan migrate
```

## Usage

```php
use TemplateGenerator\Contracts\TemplateGeneratorContract;

public function generate(TemplateGeneratorContract $generator)
{
    $pdfBinary = $generator->generatePdf($templateId, [
        "App\\Models\\Client" => 5,
    ]);
}
```
