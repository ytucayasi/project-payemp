<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Styles -->
  @livewireStyles
</head>

<body>
  <div class='app'>
    <nav class='sidebar'>
      <ul class='sidebar-menu'>
        <li class='sidebar-menu-item'>
          <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            <i class="fa fa-users sidebar-menu-item-link-icon" aria-hidden="true"></i>
            <span class='sidebar-menu-item-link-text'>{{ __('Empleados') }}</span>
          </x-nav-link>
        </li>
        <li class='sidebar-menu-item'>
          <x-nav-link href="{{ route('pagos') }}" :active="request()->routeIs('pagos')">
            <i class="fa fa-users sidebar-menu-item-link-icon" aria-hidden="true"></i>
            <span class='sidebar-menu-item-link-text'>{{ __('Pagos') }}</span>
          </x-nav-link>
        </li>
      </ul>
    </nav>
    {{ $slot }}
  </div>
  @stack('modals')

  @livewireScripts
</body>

</html>