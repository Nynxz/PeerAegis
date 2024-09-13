<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="{{ asset('graduation-hat-svgrepo-com.svg') }}">
        @vite('resources/css/app.css')

        <title>{{ $title ?? 'Reviews' }}</title>

        <div class="flex flex-row bg-primary" >
            <div class="flex flex-grow bg-primary rounded-br-lg max-w-8 border-gray-600 border-b-[1px] border-r-[1px]"></div>
            <h1 class="text-2xl flex font-bold  p-4 mb-0 rounded text-white bg-secondary">
                <a href="">Course Reviews</a>
            </h1>
            <div class="flex flex-grow bg-primary rounded-bl-lg border-gray-600 border-[1px] border-t-0 border-r-0">
                <ul class="my-auto pr-4 text-white text-xl justify-center flex flex-grow gap-2">
                    <li><a class="hover:underline" href="/" wire:navigate>Home</a></li>
                    <li><a class="hover:underline" href="/test" wire:navigate>Test</a></li>
                </ul>
            </div>

        </div>
    </head>
    <body class="bg-secondary">
        {{ $slot }}
    </body>
</html>
