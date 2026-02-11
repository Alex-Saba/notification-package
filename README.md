# notification-package

Laravel package that generates PDF documents from stored templates and entity data.

## Installation

Add the VCS repository and require the package:

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

## Entities payload

The `entities` argument must be an array keyed by model FQCN:

```php
[
    "App\\Models\\Client" => 5,
    "App\\Models\\Societe" => 12
]
```
