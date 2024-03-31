<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-hidden">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Notes') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <main class="flex justify-center items-center flex-col min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid min-h-[140px] w-full place-items-center rounded-lg">
                <figure class="relative w-full h-96">
                    <img class="object-cover object-center w-full h-full rounded-xl"
                        src="{{ asset('img/darling.jpg') }}" alt="nature image" />
                    <a href="/login"
                        class="absolute top-5 left-5 text-light-300 bg-transparent hover:bg-white hover:text-dark-400 py-1 px-2 rounded border font-semibold border-pink-50">
                        LOGIN
                    </a>
                    <figcaption
                        class="absolute bottom-8 left-2/4 flex w-[calc(100%-4rem)] -translate-x-2/4 justify-between rounded-xl border border-white bg-white/75 py-4 px-6 shadow-lg shadow-black/5 saturate-200 backdrop-blur-sm">
                        <div>
                            <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Welcome To Notes Apps
                            </h5>
                            <p
                                class="block font-sans text-base antialiased font-normal leading-relaxed text-blue-gray-900 text-[12px]">
                                Made With <span class="text-pink-500 font-semibold">♥</span>, By Dho
                            </p>

                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
        {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center gap-3">
                <div>1</div>
                <div>2</div>
            </div>
        </div> --}}
    </main>

</body>

</html>
