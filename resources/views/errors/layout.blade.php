<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('graduation-hat-svgrepo-com.svg') }}">
    @vite('resources/css/app.css')
    <script src="{{ asset('important.js') }}" defer></script>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
        }
    </style>

    <title>@yield('title')</title>
    <livewire:components.navbar/>

</head>
<body class="bg-secondary flex flex-grow h-screen flex-col w-screen">
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            @yield('message')
            <img src="{{ asset('404-monster.png') }}" class="w-7" alt="monster">
        </div>
    </div>
</div>
</body>
</html>
