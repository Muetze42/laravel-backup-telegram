# Telegram notifications for [spatie/laravel-backup](https://github.com/spatie/laravel-backup)


## Install
Install and configure these packages:
* [spatie/laravel-backup](https://github.com/spatie/laravel-backup)
* [laravel-notification-channels/telegram](https://github.com/laravel-notification-channels/telegram)

``` bash
composer require norman-huth/laravel-backup-telegram
```

Set up the Telegram receiver and notifications in the `config/backup.php`:
``` php
    'notifications' => [

        'notifications' => [
            \NormanHuth\LaravelBackupTelegram\BackupHasFailed::class => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\UnhealthyBackupWasFound::class => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\CleanupHasFailed::class => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\BackupWasSuccessful::class => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\HealthyBackupWasFound::class => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\CleanupWasSuccessful::class => ['telegram'],
        ],

        'notifiable' => \Spatie\Backup\Notifications\Notifiable::class,

        'telegram' => [
            'to' => -1234567890,
        ],

        'mail' => [
```

Example: Mail & Telegram notifications:
``` php
        'notifications' => [
            \NormanHuth\LaravelBackupTelegram\BackupHasFailed::class         => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\UnhealthyBackupWasFound::class => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\CleanupHasFailed::class        => ['telegram'],
            \NormanHuth\LaravelBackupTelegram\BackupWasSuccessful::class     => ['mail'],
            \NormanHuth\LaravelBackupTelegram\HealthyBackupWasFound::class   => ['mail'],
            \NormanHuth\LaravelBackupTelegram\CleanupWasSuccessful::class    => ['mail'],
        ],
```
