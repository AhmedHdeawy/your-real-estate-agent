<?php

namespace App\Notifications;

use App\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestJoinStatus extends Notification implements ShouldQueue
{
    use Queueable;

    public $group;
    public $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Group $group, $status)
    {
        $this->group = $group;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'group_name' => $this->group->name,
            'group_unique_name' => $this->group->unique_name,
            'status' => $this->status,
        ];
    }
}
