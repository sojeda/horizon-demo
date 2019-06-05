<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FetchedStarWarsEntity extends Notification
{
    use Queueable;

    /**
     * The star wars entity
     *
     * @var array
     */
    private $entity = [];

    /**
     * Create a new notification instance.
     *
     * @param array $entity
     */
    public function __construct(array $entity)
    {
        $this->setEntity($entity);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $response = json_encode($this->getEntity());

        return (new MailMessage)
            ->line(sprintf('Info about Star Wars character: #%1$s.', json_encode($this->getEntity())))
            ->action('More details', url('/'))
            ->line(json_encode($response));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * @return array
     */
    public function getEntity(): array
    {
        return $this->entity;
    }

    /**
     * @param array $entity
     */
    public function setEntity(array $entity)
    {
        $this->entity = $entity;
    }
}
