@php
    $profile = Auth::user()->profile;
@endphp

<div class="w-full flex items-center p-3">

    <div class="py-2 px-4 rounded-lg bg-white shadow-sm text-sm font-bold border border-secondary w-1/3">
        @role('tenant')
            {{ $profile->last_name }}, {{ $profile->first_name }}
        @endrole

        @if(!$profile)
            {{ Auth::user()->name}}
        @endif
    </div>
</div>
