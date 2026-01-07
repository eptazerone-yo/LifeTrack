<!DOCTYPE html>
<html lang="en" data-theme="light">
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
        /* =====================
           THEME VARIABLES
        ===================== */
        :root {
            --bg: #F8FAFC;
            --sidebar: #ffffff;
            --card: #ffffff;
            --text: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;
            --primary: #6366F1;
        }

        /* =====================
           DARK MODE
        ===================== */
        [data-theme="dark"] {
            --bg: #111827;
            --sidebar: #0f172a;
            --card: #1e293b;
            --text: #e5e7eb;
            --muted: #9ca3af;
            --border: #374151;
            --primary: #818cf8;
            color-scheme: dark;
        }

        /* =====================
           GLOBAL
        ===================== */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            transition: background-color .25s ease, color .25s ease;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* =====================
           SIDEBAR
        ===================== */
        .sidebar {
            width: 240px;
            background-color: var(--sidebar);
            border-right: 1px solid var(--border);
            padding: 24px;
        }

        .sidebar h4 {
            color: var(--text);
        }

        .sidebar .slogan {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .sidebar a {
            font-size: 0.9rem;
            padding: 10px 14px;
            border-radius: 8px;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: rgba(99,102,241,0.12);
            color: var(--primary);
        }

        .sidebar a.active {
            background-color: var(--primary);
            color: #fff;
            font-weight: 600;
        }

        /* =====================
           CONTENT
        ===================== */
        .content {
            flex: 1;
            padding: 32px;
        }

        /* =====================
           CARD
        ===================== */
        .card {
            background-color: var(--card);
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        /* =====================
           HEADER PROFILE
        ===================== */
        .header-profile {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .header-profile .name {
            font-weight: 500;
            color: var(--text);
        }

        /* =====================
           DARK MODE BUTTON
        ===================== */
        .theme-toggle {
            background-color: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .theme-toggle:hover {
            background-color: rgba(99,102,241,0.15);
        }

        /* =====================
           LOGOUT BUTTON
        ===================== */
        .btn-logout {
            border: 1px solid #b91c1c;
            color: #b91c1c;
            background: transparent;
        }

        .btn-logout:hover {
            background-color: #b91c1c;
            color: #fff;
        }

        /* =====================
           BOOTSTRAP DARK FIX
        ===================== */


        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background-color: #020617;
            color: var(--text);
            border-color: var(--border);
        }

        [data-theme="dark"] .form-control::placeholder {
            color: var(--muted);
        }

        /* =====================
           TEXT VISIBILITY FIX (INI YANG PENTING)
        ===================== */
       

        
        [data-theme="dark"] .text-secondary {
            color: var(--muted) !important;
        }

        [data-theme="dark"] .text-dark {
            color: var(--text) !important;
        }

        [data-theme="dark"] .badge {
            color: #fff;
        }
/* =====================
   TABLE DARK MODE – CLEAN & MODERN
===================== */
[data-theme="dark"] .table {
    background-color: rgba(255,255,255,0.035);
    color: var(--text);
    border-radius: 14px;
    overflow: hidden;
    border-collapse: separate;
    border-spacing: 0;
}

/* HEADER */
[data-theme="dark"] .table thead th {
    background-color: var(--card);
    color: var(--text);
    font-weight: 600;
    padding: 16px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    border-left: none;
    border-right: none;
}

/* BODY ROW */
[data-theme="dark"] .table tbody tr {
    background-color: transparent;
}

/* CELL */
[data-theme="dark"] .table td {
    padding: 16px;
    color: var(--text);
    border-bottom: 1px solid rgba(255,255,255,0.045);
    border-left: none;
    border-right: none;
}

/* LAST ROW */
[data-theme="dark"] .table tbody tr:last-child td {
    border-bottom: none;
}

/* STRIPED (SUPER HALUS) */
[data-theme="dark"] .table-striped > tbody > tr:nth-of-type(odd) {
    background-color: rgba(255,255,255,0.02);
}

/* HOVER */
[data-theme="dark"] .table tbody tr:hover {
    background-color: rgba(99,102,241,0.10);
}
/* =====================
   BOOTSTRAP TABLE BG FIX (DARK MODE)
===================== */
[data-theme="dark"] .table > :not(caption) > * > * {
    background-color: transparent !important;
    color: var(--text);
}
/* =====================
   DASHBOARD CARD & LIST – DARK MODE FIX
===================== */

/* CARD */


/* CARD HEADER */
[data-theme="dark"] .card-header {
    background-color: transparent;
    color: var(--text);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

/* CARD BODY */
[data-theme="dark"] .card-body {
    background-color: transparent;
    color: var(--text);
}

/* LIST ITEM */
[data-theme="dark"] .list-group-item {
    background-color: transparent !important;
    color: var(--text);
    border: none;
    border-bottom: 1px solid rgba(255,255,255,0.04);
}

/* LAST ITEM */
[data-theme="dark"] .list-group-item:last-child {
    border-bottom: none;
}

/* BADGE / SMALL TEXT */
[data-theme="dark"] .card small,
[data-theme="dark"] .text-muted {
    color: var(--muted) !important;
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
            <div class="slogan">Track your time, money, and priorities</div>
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
                <button class="btn btn-logout btn-sm w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="content">

        {{-- HEADER --}}
        <div class="header-profile">
            <button id="toggleTheme" class="theme-toggle" title="Toggle Dark Mode">
                <i id="themeIcon" class="bi bi-moon"></i>
            </button>

            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center"
                 style="width:40px;height:40px;">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
            <span class="name">{{ auth()->user()->name }}</span>
        </div>

        <div class="container">
            @yield('content')
        </div>
    </main>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const html = document.documentElement;
    const toggle = document.getElementById('toggleTheme');
    const icon = document.getElementById('themeIcon');

    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    icon.className = savedTheme === 'dark' ? 'bi bi-sun' : 'bi bi-moon';

    toggle.addEventListener('click', () => {
        const theme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        icon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
    });
</script>

@yield('scripts')
</body>
</html>
