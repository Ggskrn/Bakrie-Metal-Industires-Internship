<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Login - KOP AJS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-white via-amber-50/20 to-blue-50/30 font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        @yield('content')
    </div>
</body>
</html>