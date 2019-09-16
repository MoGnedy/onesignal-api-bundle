OneSignalNotificationsBundle
========================

Integrate OneSignal API in Symfony with ease.

Use the [PHP library made by Norkunas](https://github.com/norkunas/onesignal-php-api).

## Setup

Install with Composer

    Soon
    
Add bundle to app/bundles.php

  return [
            ....
    App\Bundle\OneSignalNotificationsBundle\OneSignalNotificationsBundle::class => ['all' => true]
    ]

## Configuration

Add this to your `config.yml`:

```yaml
one_signal_notifications:
    app_id: '%env(one_signal_app_id)%'
    api_key: '%env(one_signal_api_key)%'
```

## Use

Send a simple notification:

```php
$client = $this->get('app_onesignal_notifications.service.client');

$client->notifications->add([
    'headings' => [
        'en' => 'message headings'
    ],
    'contents' => [
        'en' => 'message content'
    ],
    'included_segments' => ['All'],
]);
```

## License

MIT Licensed, see LICENSE.
Author: Mohamed Gnedy