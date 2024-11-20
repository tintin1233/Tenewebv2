<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $tenement = $user->tenant->room->tenement;

        $conversations = Conversation::where('user_id', $user->id)
            ->where('tenement_id', $tenement->id)
            ->with(['messages' => function ($q) {
                $q->with([
                    'sender',
                    'receiver'
                ])->latest()->get();
            }, 'user', 'participant'])
            ->withCount(['messages as unread_messages_count' => function ($q) use ($user) {
                $q->where('is_seen', false)
                    ->where('receiver_id', $user->id);
            }])
            ->get();

        // if(!$conversation){
        //     $conversation = Conversation::create([
        //         'user_id' => $user->id,
        //         'tenement_id' => $tenement->id
        //     ]);
        // }

        $admins = User::whereHas('adminProfile', function ($q) use ($tenement) {
            $q->where('tenement_id', $tenement->id);
        })->get();

        return response([
            'conversations' => $conversations,
            'admins' => $admins
        ]);
    }

    public function addMessage(Request $request, string $id)
    {
        $conversation = Conversation::find($id);

        $admin = $conversation->tenement->adminProfile->user;

        $user = Auth::user();


        ConversationMessage::create([
            'content' => $request->message,
            'sender_id' => $user->id,
            'receiver_id' => $admin->id,
            'conversation_id' => $conversation->id,
            'role' => $user->roles()->first()->name
        ]);



        return response([
            'message' => 'sent'
        ]);
    }

    public function createAdminConversation(string $id)
    {
        $user = Auth::user();

        $tenement = $user->tenant->room->tenement;
        $hasConversations = Conversation::where(function($q) use($user, $id) {
            $q->where(function($q) use($user) {
                $q->where('participant_id', $user->id)
                ->orWhere('user_id', $user->id);
            })
            ->orWhere(function($q) use($id){
                $q->where('participant_id', $id)
                ->orWhere('user_id', $id);
            });
        })->exists();
        if($hasConversations) {
            return response([
                'message' => 'Already have Conversation'
            ], 405);
        }


        $conversation = Conversation::create([
            'user_id' => $user->id,
            'tenement_id' => $tenement->id,
            'participant_id' => $id
        ])->with(['tenement', 'participant', 'user']);

        return back()->with([
            'conversation' => $conversation
        ]);
    }
}
