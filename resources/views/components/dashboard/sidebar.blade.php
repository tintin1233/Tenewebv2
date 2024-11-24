@props([
    'links' => [],
])


@php
    use App\Models\Tenement;
    $user = Auth::user();
    $profile = $user->profile ?? null;
    $tenement = Tenement::where(function ($q) {
        $q->whereHas('rooms', function ($q) {
            $q->whereHas('tenants', function ($q) {
                $q->where('user_id', Auth::user()->id);
            });
        })->orWhereHas('adminProfile', function ($q) {
            $q->where('user_id', Auth::user()->id);
        });
    })->first();

@endphp
<style>
    /* Optional: Custom Transition for Sidebar */
#sidebar {
    transition: width 0.3s ease-in-out;
}

#sidebar-content {
    transition: opacity 0.3s ease-in-out;
}

#sidebar.hidden {
    display: none;
}

</style>
<div class="w-1/5 h-screen flex flex-col bg-white border border-secondary" id="sidebar">
    <!-- Burger Icon for Mobile -->
    <div class="flex items-center justify-between p-4 md:hidden">
        <button id="burger-icon" class="text-3xl">
            <i class="fi fi-rr-menu-burger"></i>
        </button>
        <a href="{{ route('tenant.profile.show') }}" class="text-2xl text-accent">
            @if ($profile)
                <img src="{{ $profile->image }}" class="h-12 w-12 rounded-full object-center" />
            @else
                <i class="fi fi-rr-circle-user"></i>
            @endif
        </a>
    </div>

    <div class="flex items-center border-b border-secondary p-2 justify-between hidden md:flex">
        <div class="flex items-center gap-2">
            <img src="{{ asset('logo.png') }}" class="h-12 w-12 rounded-full" />
            <h1 class="font-bold text-lg text-neutral capitalize">
                ciudad de strike
                @if ($tenement)
                    <span>
                        {{ $tenement->name }}
                    </span>
                @endif
            </h1>
        </div>

        <a href="{{ route('tenant.profile.show') }}" class="text-2xl text-accent">
            @if ($profile)
                <img src="{{ $profile->image }}" class="h-12 w-12 rounded-full object-center" />
            @else
                <i class="fi fi-rr-circle-user"></i>
            @endif
        </a>
    </div>

    <div class="p-4 mt-5 flex flex-col gap-5 justify-between h-full overflow-y-auto" id="sidebar-content">
        <div class="h-auto w-full  flex flex-col gap-5">
            @foreach ($links as $link)
                <a href="{{ $link['url'] ? route($link['url']) : '#' }}"
                    class="flex items-center w-full text-sm gap-2 p-2 rounded-lg
            {{ Route::is($link['url'])
                ? 'bg-secondary font-bold text-accent'
                : 'hover:bg-secondary hover:font-bold duration-700 hover:text-accent' }}
            ">
                    {!! $link['icon'] !!}
                    <span class="capitalize">
                        {{ $link['name'] }}
                    </span>

                    @if ($link['badgeTotal'] !== 0)
                        <div class="grow flex justify-end">
                            <span
                                class="text-white flex items-center justify-center w-5 aspect-square rounded-full bg-error">
                                {{ $link['badgeTotal'] }}
                            </span>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
        <div>
            <form method="POST" action="{{ route('logout') }}"
                class="flex items-center w-full text-neutral gap-2 text-sm hover:bg-secondary hover:font-bold duration-700 p-2 rounded-lg">
                @csrf
                <i class="fi fi-rr-sign-out-alt"></i>
                <button class="capitalize">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript to toggle the sidebar on and off for mobile
    const burgerIcon = document.getElementById("burger-icon");
    const sidebarContent = document.getElementById("sidebar-content");
    const sidebar = document.getElementById("sidebar");

    // Toggle sidebar visibility
    burgerIcon.addEventListener("click", () => {
        sidebarContent.classList.toggle("hidden");
        sidebar.classList.toggle("w-1/5"); // Toggle width for mobile view
        sidebar.classList.toggle("w-4/5"); // Adjust width for expanded state
    });
</script>
