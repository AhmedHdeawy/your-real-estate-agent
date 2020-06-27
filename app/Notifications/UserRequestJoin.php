<?php

namespace App\Notifications;

use App\Models\GroupRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRequestJoin extends Notification implements ShouldQueue
{
    use Queueable;

    public $group;
    public $user;
    public $groupRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($group, $user, GroupRequest $groupRequest)
    {
        $this->group = $group;
        $this->user = $user;
        $this->groupRequest = $groupRequest;
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
            'group_id' => $this->group->id,
            'group_name' => $this->group->name,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'userAnswers' => $this->groupRequest->userAnswers,
        ];
    }
}
