<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $user = Auth::user();


        $tenement = $user->adminProfile->tenement;


        $conversations = Conversation::where('tenement_id', $tenement->id)
        ->where('participant_id', $user->id)
        ->with(['user', 'messages' => function ($q) use ($user) {
            $q->with([
                'sender',
                'receiver'
            ]);
        }])
            ->withCount(['messages as unread_messages_count' => function ($q) use ($user) {
                $q->where('is_seen', false)
                    ->where('receiver_id', $user->id);
            }])
            ->latest()->paginate(10);


        return response([
            'conversations' => $conversations
        ]);
    }

    public function addMessage(Request $request, string $id)
    {
        $conversation = Conversation::find($id);


        $user = Auth::user();


        ConversationMessage::create([
            'content' => $request->message,
            'sender_id' => $user->id,
            'receiver_id' => $conversation->user->id,
            'conversation_id' => $conversation->id,
            'role' => $user->roles()->first()->name
        ]);


        return response([
            'message' => 'sent'
        ]);
    }
}
