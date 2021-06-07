<?php

namespace NormanHuth\LaravelBackupTelegram;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage as Message;
use Spatie\Backup\Notifications\Notifications\BackupHasFailed as BaseNotification;
use NormanHuth\LaravelBackupTelegram\Traits\Messages;

class BackupHasFailed extends BaseNotification
{
    use Messages;

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
        $this->message = '**'.__('backup::notifications.backup_failed_subject', ['application_name' => $this->applicationName()])."**\n\n";
        $this->message.= __('backup::notifications.backup_failed_body', ['application_name' => $this->applicationName()])."\n";
        $this->message.= $this->exceptionMessage();
        $this->message.= __('backup::notifications.exception_trace', ['trace' => $this->event->exception->getTraceAsString()])."\n";

        $this->backupDestinationProperties()->each(function ($value, $name) {
            $this->message.="\n{$name}: `$value`\n";
        });

        return Message::create()
            ->to(config('backup.notifications.telegram.to'))
            ->content($this->message);
    }
}
