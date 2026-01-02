@extends('layouts.guest')

@section('content')

{{-- SHAKE ANIMATION --}}
<style>
@keyframes shake {
    0% { transform: translateX(0); }
    20% { transform: translateX(-6px); }
    40% { transform: translateX(6px); }
    60% { transform: translateX(-6px); }
    80% { transform: translateX(6px); }
    100% { transform: translateX(0); }
}

.shake {
    animation: shake 0.45s ease-in-out;
}
</style>

<div class="row min-vh-100 align-items-center">

    {{-- LEFT BRAND --}}
    <div class="col-md-6 d-none d-md-flex p-5 flex-column bg-gray-100 justify-content-center">

        <div>
            <h1 class="fw-bold mb-3 lifetrack-title">LifeTrack</h1>
            <p class="text-muted">
                Track your time, money, and priorities
            </p>
        </div>

        <div class="flex-grow-1 d-flex align-items-center justify-content-center">
            <lottie-player
                src="/json/login.json"
                style="width:320px; height:320px"
                background="transparent"
                speed="1"
                loop
                autoplay>
            </lottie-player>
        </div>
    </div>

    {{-- RIGHT FORM --}}
    <div class="col-md-6 p-5">

        <h3 class="fw-bold mb-2">Welcome Back</h3>
        <p class="text-muted mb-4">Login to continue</p>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="alert alert-danger shake">
                Email atau password tidak sesuai.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control {{ $errors->any() ? 'shake' : '' }}"
                    required
                    autofocus
                >
            </div>

            {{-- PASSWORD --}}
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control {{ $errors->any() ? 'shake' : '' }}"
                    required
                >
            </div>

            <button class="btn btn-dark w-100">
                Login
            </button>

            <p class="text-center mt-3 text-muted">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-dark fw-semibold">
                    Register
                </a>
            </p>
        </form>
    </div>

</div>
@endsection
