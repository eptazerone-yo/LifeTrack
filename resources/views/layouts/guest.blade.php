<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LifeTrack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet">


    <style>
    .lifetrack-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        letter-spacing: -0.5px;
        font-size: 2.4rem;
    }


        .lottie-box {
            width: 100%;
            max-width: 360px;
            height: 360px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

@yield('content')

<!-- LOTTIE LIBRARY (WAJIB ADA DI SINI) -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

@yield('scripts')
</body>
</html>
