<?php

namespace App\Http\Controllers\Front;

use App\User;
use Validator;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        // $messages = Message::where('sender_id', Auth::id())->where('receiver_id', $friend_id)->get();

        $messages = Message::where(function ($query) use ($friend_id) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $friend_id);
        })
        ->orWhere(function ($query) use ($friend_id) {
            $query->where('sender_id', $friend_id)->where('receiver_id', Auth::id());
        })
        ->orderBy('created_at')
        ->get();

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

        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }
}
