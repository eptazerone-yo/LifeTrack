<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LifeTrack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 24px;
        }

        .sidebar h4 {
            font-size: 1.15rem;
            color: #111827;
        }

        .sidebar .slogan {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .sidebar a {
            font-size: 0.9rem;
            padding: 10px 14px;
            border-radius: 8px;
            color: #374151;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background-color: #EEF2FF;
            color: #4338CA;
        }

        .sidebar a.active {
            background-color: #4338CA;
            color: #ffffff;
            font-weight: 600;
        }

        /* Logout Button */
        .btn-logout {
            border: 1px solid #b91c1c;
            color: #b91c1c;
            background-color: transparent;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: #b91c1c;
            color: #ffffff;
        }

        /* Header Profile */
        .header-profile {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 1rem;
            gap: 0.5rem;
        }

        .header-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .header-profile img:hover {
            transform: scale(1.1);
            border: 2px solid #6366F1;
        }

        .header-profile .name {
            font-weight: 500;
            color: #374151;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 32px;
        }

        /* CARD */
        .card {
            border-radius: 12px;
            border: none;
        }

        /* PRIMARY BUTTON */
        .btn-primary {
            background-color: #6366F1;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4F46E5;
        }
    </style>
</head>
<body>

<div class="wrapper">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">
                <i class="bi bi-journal-check"></i> LifeTrack
            </h4>
            <div class="slogan">
                Track your time, money, and priorities
            </div>
        </div>

        <nav class="d-grid gap-2">
            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('schedule.index') }}" class="{{ request()->is('schedule*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> Schedule
            </a>

            <a href="{{ route('finance.index') }}" class="{{ request()->is('finance*') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i> Finance
            </a>

            <a href="{{ route('wishlist.index') }}" class="{{ request()->is('wishlist*') ? 'active' : '' }}">
                <i class="bi bi-heart"></i> Wishlist
            </a>

            <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profile
            </a>

            <hr>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout w-100 btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="content">

        {{-- Header profile kanan --}}
        <div class="header-profile">
            <a href="{{ route('profile.edit') }}">
                    <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center"
                        style="width:40px; height:40px;">
                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                    </div>
            </a>
            <span class="name">{{ auth()->user()->name }}</span>
        </div>
        <div class="container">
    <!-- Flash messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</div>
</div>
@yield('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>
