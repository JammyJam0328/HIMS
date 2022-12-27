<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>KIOSK | HOTEL</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    [x-cloak] {
      display: none;
    }
  </style>
  @livewireStyles

</head>

<body class="font-rubik antialiased bg-gray-600">
  <div class="fixed inset-0 bg-gradient-to-t from-transparent to-gray-600 w-full h-full overflow-hidden">
    <img src="{{ asset('images/hotel-bg.jpg') }}" class="object-cover opacity-20" alt="">
  </div>

  <div
    class="absolute text-gray-300 flex justify-end items-end pb-5 pr-10 text-sm font-rubik font-medium w-full h-full">
    POWERED BY: J7 I.T SOLUTION & SERVICES</div>
  <div class="relative">
    @yield('content')

    <x-my-alert />
    @stack('scripts')
    @livewireScripts

</body>

</html>
