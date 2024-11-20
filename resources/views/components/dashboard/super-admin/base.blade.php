@php
    $links = [
        [
            'url' => 'super-admin.dashboard',
            'name' => 'dashboard',
            'icon' => '<i class="fi fi-rr-dashboard"></i>',
            'badgeTotal' => 0
        ],
        [
            'url' => "super-admin.tenements.index",
            'name' => 'tenements',
            'icon' => '<i class="fi fi-rr-house-building"></i>',
            'badgeTotal' => 0
        ],
        [
            'url' => 'super-admin.users.index',
            'name' => 'users',
            'icon' => '<i class="fi fi-rr-users-alt"></i>',
            'badgeTotal' => 0
        ],
        [
            'url' => "super-admin.master-list.index",
            'name' => 'master list',
            'icon' => '<i class="fi fi-rr-overview"></i>',
            'badgeTotal' => 0
        ],
        [
            'url' => 'super-admin.announcements.index',
            'name' => 'Announcements',
            'icon' => '<i class="fi fi-rr-megaphone"></i>',
            'badgeTotal' => 0,
        ],
        [
            'url' => 'super-admin.bills.index',
            'name' => 'bills',
            'icon' => '<i class="fi fi-rr-point-of-sale-bill"></i>',
            'badgeTotal' => 0,
        ],
        [
            'url' => "super-admin.report.index",
            'name' => 'revenue',
            'icon' => '<i class="fi fi-rr-newspaper"></i>',
            'badgeTotal' => 0
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
    </x-dashboard.content-wrapper>

</x-app-layout>
