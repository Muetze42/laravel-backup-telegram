<?php

namespace NormanHuth\LaravelBackupTelegram;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage as Message;
use Spatie\Backup\Notifications\Notifications\HealthyBackupWasFound as BaseNotification;

class HealthyBackupWasFound extends BaseNotification
{
    protected string $message;

    public function via(): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return Message
     */
    public function toTelegram(): Message
    {
        $this->message = '**'.__('backup::notifications.healthy_backup_found_subject', ['application_name' => $this->applicationName(), 'disk_name' => $this->diskName()])."**\n\n";
        $this->message.= __('backup::notifications.healthy_backup_found_body', ['application_name' => $this->applicationName()])."\n";

        $this->backupDestinationProperties()->each(function ($value, $name) {
            $this->message.="\n{$name}: `$value`\n";
        });

        return Message::create()
            ->to(config('backup.notifications.telegram.to'))
            ->content($this->message);
    }
}
