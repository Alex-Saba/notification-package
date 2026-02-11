# notification-package

Plugin Laravel de notification qui genere des documents PDF a partir de templates stockes en base, puis les envoie par canal (mail/log).

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
use TemplateGenerator\Contracts\NotificationSenderContract;

public function send(NotificationSenderContract $notifier)
{
    $notifier->sendTemplatePdf([
        'to' => 'client@example.com',
        'subject' => 'Votre document',
        'template_id' => 10,
        'entities' => [
            'App\\Models\\Client' => 5,
        ],
        'channels' => ['mail', 'log'],
        'filename' => 'document.pdf',
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

## Configuration

Publier le fichier de config si besoin:

```bash
php artisan vendor:publish --tag=notification-package-config
```

`config/notification-package.php`:

```php
return [
    'channels' => ['mail'],
];
```
