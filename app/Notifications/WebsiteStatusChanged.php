<?php

namespace App\Notifications;

use App\StardewWatcher\Enums\WebsiteStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WebsiteStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public \App\Events\WebsiteStatusChanged $event)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Статус проверки сайта сменился на ' . match ($this->event->newWebsiteStatus) {
                            WebsiteStatus::Fail => '"Не пройдено"',
                            WebsiteStatus::Ok => '"Пройдено"',
                            default => '"Что-то непонятное"'
                        });
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
