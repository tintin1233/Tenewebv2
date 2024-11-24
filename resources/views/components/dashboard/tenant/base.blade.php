@php

    use App\Models\{
        Announcement,
        Bill
    };
    $user = Auth::user();

    $tenement = $user->tenant->room->tenement;


    $totalNewAnnouncements = Announcement::whereDoesntHave('userViews', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->where('tenement_id', $tenement->id)
    ->where('is_archived', false)->count();


    $totalBills = $user->tenant->bills()->where('is_viewed', false)->count();

@endphp


@php
    $links = [
        [
            'url' => 'tenant.dashboard',
            'name' => 'dashboard',
            'icon' => '<i class="fi fi-rr-dashboard"></i>',
            'badgeTotal' => 0
        ],
        [
            'url' => 'tenant.announcements.index',
            'name' => 'Announcements',
            'icon' => '<i class="fi fi-rr-megaphone"></i>',
            'badgeTotal' => $totalNewAnnouncements
        ],
        [
            'url' => 'tenant.bills.index',
            'name' => 'bills',
            'icon' => '<i class="fi fi-rr-file-invoice-dollar"></i>',
            'badgeTotal' => $totalBills
        ],
        [
            'url' => 'tenant.documents.index',
            'name' => 'documents',
            'icon' => '<i class="fi fi-rr-document-signed"></i>',
            'badgeTotal' => 0
        ],
        [
            'url' => 'tenant.family-members.index',
            'name' => 'Family',
            'icon' => '<i class="fi fi-rr-family-dress"></i>',
            'badgeTotal' => 0,
        ],
    ];
@endphp

<x-app-layout>

    <x-dashboard.content-wrapper>
        <div class="flex gap-5 w-full">
            <x-dashboard.sidebar :links="$links" />
            <div class="w-5/6 h-full flex flex-col gap-2">
                <x-dashboard.header />
                <div class="p-2 h-auto w-full flex flex-col gap-2">
                    {{ $slot }}
                </div>
            </div>
        </div>


        <div class="fixed bottom-10 right-10  z-10 w-16 flex items-center justify-center aspect-square rounded-full"
            x-data="chatData">
            <button x-ref="message" @click="open = !open" class="text-accent relative">
                <img src="{{ asset('images/icons/speech-bubble.gif') }}" alt="" class="w-12 aspect-square">
                <p class="aspect-square rounded-full bg-error text-white text-xs absolute top-0 -right-5 p-1" x-show="unreadMessages !== 0">
                    <span x-text="unreadMessages">

                    </span>
                </p>
            </button>
            <div x-show="open" x-anchor.top-start="$refs.message"
                class="bg-white rounded-lg p-5 shadow-lg h-[30rem]
            w-[25rem] flex flex-col gap-5" x-init="getTenantConversations">
                <div class="bg-primary rounded-lg p-2 flex items-center gap-2">
                    <button class="btn btn-xs btn-accent" @click="conversation = null" x-show="conversation">Back</button>
                    <h1 class="text-accent text-lg font-semibold">Message</h1>
                </div>

                <template x-if="!conversation">
                    <div class="h-96 overflow-y-auto flex flex-col gap-2 p-5">
                        <div>
                            <div class="flex items-center gap-2">
                                <h1 class="text-lg font-bold text-primary">Admins :</h1>
                                <template x-for="admin in admins" :key="admin.id">
                                    <button @click="createAdminConversation(admin.id)" class="btn btn-sm btn-accent">
                                        <span x-text="admin.name"></span>
                                    </button>
                                </template>

                            </div>
                            <template x-if="conversations.length === 0">
                                <div class="h-full w-full flex items-center justify-center">
                                    <h1 class="font-semibold">
                                        No Conversation
                                    </h1>
                                </div>
                            </template>
                            <template x-if="conversations.length !== 0">
                                <template x-for="(_conversation, index) in conversations" :key="_conversation.id">
                                    <a href="#" @click="selectConversation(_conversation)"
                                        class="w-full h-24 flex items-center gap-2 bg-gray-50 rounded-lg shadow-sm p-2 hover:scale-105 duration-700 hover:shadow-lg">
                                        <div class="flex flex-col items-center">
                                            <img src="{{ asset('images/icons/man.png') }}" alt="" srcset=""
                                                class="w-12 aspect-square">
                                            <p class="text-sm text-primary" x-text="_conversation.participant.name"> </p>
                                        </div>

                                        <div class="grow">
                                            <p :class="$ { _conversation.messages[0].is_seen == 0 ? ' ' : ' font-bold' }"
                                                x-text="_conversation.messages[0].content"></p>
                                            <p class="text-xs text-gray-500 text-end"
                                                x-text="_conversation.messages[0].created_at"></p>
                                        </div>
                                        <p class="aspect-square rounded-full bg-error text-white text-xs  p-1" x-show="_conversation?.unread_messages_count">
                                            <span x-text="unreadMessages">

                                            </span>
                                        </p>
                                    </a>
                                </template>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="conversation">
                    <div class="w-auto h-auto">
                        <div class="h-96 overflow-y-auto flex flex-col-reverse gap-2 p-5">
                            <template x-if="conversation?.messages.length === 0">
                                <div class="flex items-center justify-center">
                                    <h1 class="text-xs text-gray-600">
                                        Sent Message to admin
                                    </h1>
                                </div>
                            </template>

                            <template x-if="conversation?.messages.length !== 0">
                                <template x-for="(message, index) in conversation?.messages" :key="message.id">
                                    <div :class="`w-full flex ${message.sender.id === {{Auth::user()->id}} ? 'justify-end ' : 'justify-start ' } rounded-lg p-2`">
                                        <div class="flex flex-col gap-2 w-1/2">
                                            <p x-text="message.content" :class="`${message.sender.id === {{Auth::user()->id}} ? ' bg-blue-500 text-white ' : ' bg-gray-200 text-black' } w-full p-2 rounded-lg `">

                                            </p>
                                                <template x-if="message.is_seen">
                                                    <p class="text-xs text-gray-400 text-end">Seen</p>
                                                </template>
                                        </div>

                                    </div>
                                </template>
                            </template>
                        </div>
                        <div class="flex gap-2 items-center w-full">
                            <input type="text" x-model="message" class="input-generic grow" placeholder="message">
                            <button>
                                <img src="{{asset('images/icons/paper-plane.gif')}}" @click="sentTenantMessage" alt="" srcset="" class="w-12 aspect-square">
                            </button>
                        </div>
                    </div>
                </template>


            </div>
        </div>


    </x-dashboard.content-wrapper>

</x-app-layout>
