<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('user.layouts.head')
</head>

<body class="homepage">
    @include('user.partials.preloader')
    @include('user.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('user.layouts.footer')
    @include('user.layouts.script')
</body>

</html>
