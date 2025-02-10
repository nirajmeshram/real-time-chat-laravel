<?php

namespace App\Http\Controllers;

use App\Events\NewMessageEvent;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->orderBy('created_at', 'asc')->get();
        return view('chat.index', compact('messages'));
    }

    public function saveMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->message = $request->input('message');
        $message->user_id = Auth::id();
        $message->save();
        try {
            broadcast(new NewMessageEvent($message));
            return response()->json(['success' => true, 'message' => 'Message saved']);
        } catch (Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
