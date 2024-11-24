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
}

.burger-icon-icon {
    font-family: 'Font Awesome 5 Free';
    content: '\f0c9'; /* Hamburger icon */
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
    border-bottom: 1px solid #ddd;
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
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s;
}

.sidebar-link.active {
    background-color: #007bff;
    color: white;
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

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        width: 70px;
    }

    .sidebar-header {
        padding: 10px;
    }

    .logo-text {
        display: none;
    }

    .sidebar-link {
        padding: 10px;
    }

    .burger-icon {
        display: block;
    }
}

@media (min-width: 769px) {
    .sidebar-header .burger-icon {
        display: none;
    }

    .sidebar.collapsed {
        width: 70px;
    }
}

</style>
<div class="sidebar" id="sidebar">
    <!-- Burger Icon for Mobile -->
    <div class="sidebar-header">
        <button id="burger-icon" class="burger-icon">
            <i class="burger-icon-icon"></i>
        </button>
        <a href="{{ route('tenant.profile.show') }}" class="profile-link">
            @if ($profile)
                <img src="{{ $profile->image }}" class="profile-img" />
            @else
                <i class="profile-icon"></i>
            @endif
        </a>
    </div>

    <!-- Logo and Tenement Info -->
    <div class="sidebar-logo">
        <img src="{{ asset('logo.png') }}" class="logo-img" />
        <h1 class="logo-text">
            Ciudad de Strike
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
            <i class="logout-icon"></i>
            <button class="logout-btn">Logout</button>
        </form>
    </div>
</div>
<script>
    // Toggle Sidebar on mobile
    const burgerIcon = document.getElementById('burger-icon');
    const sidebar = document.getElementById('sidebar');

    burgerIcon.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });
</script>
