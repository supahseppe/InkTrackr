<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta-title', config('app.name', 'inkTrackr'))</title>

    <meta
        name="description"
        content="@yield('meta-description', 'Track Your Ink')"
    />

    <!-- Improves Lighthouse score (related to Best Practices)-->
    @if (app()->environment('production'))
        <meta
            http-equiv="Content-Security-Policy"
            content="upgrade-insecure-requests"
        />
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.svg" />

    @vite(['resources-site/css/site.css'])
    @yield('headEndScripts')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

    @yield('bodyEndScripts')
</body>

</html>
