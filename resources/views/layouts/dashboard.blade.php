<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('graduation-hat-svgrepo-com.svg') }}">
    @vite('resources/css/app.css')
    <script src="{{ asset('important.js') }}" defer></script>

    <title>{{ $title ?? 'Reviews' }}</title>
    <livewire:components.navbar/>
</head>
<body class="bg-secondary flex flex-grow h-screen flex-col bg-red-500 w-screen">
{{ $slot }}
</body>
</html>
