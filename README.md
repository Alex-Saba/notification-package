# notification-package

Plugin Laravel pour generer des documents PDF a partir de templates stockes en base et de donnees d'entites.

## Installation du plugin

1) Ajouter le repo VCS et le package dans `composer.json`:

```json
"repositories": [
  { "type": "vcs", "url": "https://github.com/Alex-Saba/notification-package" }
],
"require": {
  "saba/templategenerator": "dev-main"
}
```

2) Installer les dependances et lancer les migrations:

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
