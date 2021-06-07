<?php

namespace NormanHuth\LaravelBackupTelegram\Traits;

trait Messages
{
    /**
     * @return string
     */
    public function exceptionMessage(): string
    {
        return __('backup::notifications.exception_message', ['message' => $this->event->exception->getMessage()])."\n";
    }
}
