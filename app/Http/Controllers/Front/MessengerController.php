<?php

namespace App\Http\Controllers\Front;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewMessage;
use App\User;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller
{


    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $friends = Auth::user()->friends();

        return view('front.messenger')->withFriends($friends);
    }


    /**
     * Get Chat between auth User and given friend.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getChat($friend_id)
    {

        $messages = Message::where(function ($query) use ($friend_id) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $friend_id);
        })
        ->orWhere(function ($query) use ($friend_id) {
            $query->where('sender_id', $friend_id)->where('receiver_id', Auth::id());
        })
        ->orderBy('created_at')
        ->latest()
        ->paginate(config('rbzgo.chatPerPage'));

        return $messages;
    }


    /**
     * Save New Message.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveMessage(Request $request)
    {

        $message = Message::create([
            'sender_id' =>  Auth::id(),
            'receiver_id'   =>  $request->receiver_id,
            'text'  =>  $request->text
        ]);

        // Fire Event to Others
        broadcast(new MessageSent($message))->toOthers();

        // Get Receiver
        $receiver = User::find($request->receiver_id);

        // First, to avoid duplicate the same notification from the same User, check that there is an unread notification by this User
        $check = true;
        foreach ($receiver->unreadNotifications as $notification) {
            if ($notification->type == 'App\Notifications\NewMessage' && $notification->data['user_id'] == Auth::id()) {
                $check = false;
            }
        }

        // if there is no notification, then Add it
        if ($check) {
            // Notify The User
            $receiver->notify(new NewMessage(Auth::user()));
        }

        return $message;
    }
}
