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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
/* Sidebar Styles */
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #fff;
    border-right: 1px solid #ccc;
    transition: width 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 100;
}

.sidebar.collapsed {
    width: 70px; /* Collapsed width for mobile */
}

/* Sidebar Header */
.sidebar-header {
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f4f4f4;
    border-bottom: 1px solid #ddd;
}

.burger-icon {
    font-size: 24px;
    background: none;
    border: none;
    cursor: pointer;
    display: none; /* Hide the burger icon by default */
}

.burger-icon-icon {
    font-size: 28px;
    color: #333;
}

/* Profile Image */
.profile-link {
    font-size: 20px;
}

.profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.profile-icon {
    font-size: 24px;
}

/* Logo Section */
.sidebar-logo {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid var(--fallback-s,oklch(var(--s)/var(--tw-bg-opacity)));
}

.logo-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.logo-text {
    margin-left: 10px;
    font-size: 20px;
    font-weight: bold;
}

/* Sidebar Links */
.sidebar-links {
    flex-grow: 1;
    overflow-y: auto;
}

.sidebar-link {
    display: flex;
    align-items: center;
    padding: 15px;
    text-decoration: none;
    color: #333;
    font-size: 14px;
    border-bottom: 1px solid var(--fallback-s,oklch(var(--s)/var(--tw-bg-opacity)));
    transition: background-color 0.3s;
}

.sidebar-link.active {
    background-color: var(--fallback-s,oklch(var(--s)/var(--tw-bg-opacity)));
    color: orange;
}

.sidebar-link:hover {
    background-color: #f4f4f4;
}

.link-name {
    margin-left: 10px;
}

/* Badge */
.badge-container {
    margin-left: auto;
}

.badge {
    background-color: red;
    color: white;
    padding: 5px 10px;
    border-radius: 50%;
    font-size: 12px;
}

/* Logout Section */
.sidebar-logout {
    padding: 20px;
    border-top: 1px solid #ddd;
}

.logout-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logout-icon {
    font-size: 18px;
}

.logout-btn {
    background: none;
    border: none;
    color: #333;
    font-size: 14px;
    cursor: pointer;
}

.w-5\/6 {
     width: 83.333333%; 
    margin-left: 15vh !important;
}
/* Responsive Design */
@media (max-width: 768px) {

.w-5\/6 {
     width: 83.333333%; 
    margin-left: 5vh;
}
.w-1\/3 {
    width: 100%;
}
    .sidebar {
        width: 25vh;
    }

    .sidebar-header {
        padding: 10px;
    }


    .sidebar-link {
        padding: 10px;
    }

    .burger-icon {
        display: block; /* Show burger icon on mobile */
    }

    .sidebar.collapsed .link-name {
        display: none; /* Hide sidebar links in collapsed state */
    }
    .sidebar.collapsed .logoutname{
        display:none;
    }
    .sidebar.collapsed .logo-img{
        display:none;
    }
    .sidebar.collapsed .logo-text{
        display:none;
    }

    .sidebar.collapsed .logo-img {
        width: 50px;
        height: 50px;
    }
}

@media (min-width: 769px) {
.w-5\/6 {
     width: 83.333333%; 
    margin-left: 5vh;
}
.w-1\/3 {
    width: 100%;
}
    .sidebar-header .burger-icon {
        display: none;
    }
}

</style>
<div class="sidebar" id="sidebar">
    <!-- Burger Icon for Mobile -->
    <div class="sidebar-header">
        <button id="burger-icon" class="burger-icon">
            <span class="burger-icon-icon">&#9776;</span> <!-- Burger Icon -->
        </button>

        <div class="sidebar-logo" style="border-bottom:none; padding:0;">
            <img src="{{ asset('logo.png') }}" class="logo-img" />
            <h1 class="logo-text">
                Ciudad de Strike
            </h1>
        </div>
    </div>

    <!-- Logo and Tenement Info -->
    <div class="sidebar-logo">
        <a href="{{ route('tenant.profile.show') }}" class="profile-link" style="margin-right:1vh;">
            @if ($profile)
                <img src="{{ $profile->image }}" class="profile-img" />
            @else
                <i class="profile-icon"></i>
            @endif
        </a>
        <h1 class="logo-text">
            @if ($tenement)
                <span>{{ $tenement->name }}</span>
            @endif
        </h1>
    </div>

    <!-- Sidebar Links -->
    <div class="sidebar-links">
        @foreach ($links as $link)
            <a href="{{ $link['url'] ? route($link['url']) : '#' }}"
                class="sidebar-link {{ Route::is($link['url']) ? 'active' : '' }}">
                {!! $link['icon'] !!}
                <span class="link-name">{{ $link['name'] }}</span>

                @if ($link['badgeTotal'] !== 0)
                    <div class="badge-container">
                        <span class="badge">{{ $link['badgeTotal'] }}</span>
                    </div>
                @endif
            </a>
        @endforeach
    </div>

    <!-- Logout Form -->
    <div class="sidebar-logout">
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button class="logout-btn"><i class="fa fa-sign-out"></i> <span class="logoutname">Logout</span></button>
        </form>
    </div>
</div>
<script>
    // Get references to the burger icon and sidebar
    const burgerIcon = document.getElementById('burger-icon');
    const sidebar = document.getElementById('sidebar');

    // Add event listener to toggle the sidebar's 'collapsed' class
    burgerIcon.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed'); // Toggle the collapsed state
    });
</script>
