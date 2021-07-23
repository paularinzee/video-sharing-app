<!DOCTYPE html>
<html lang="en">
<head>
        @include('front.inc.head')
</head>
<body class="hidden-sn {{config('app.skin')}}">

    @include('front.inc.header')

    @yield('content')

    @include('front.inc.footer')

    @include('front.inc.foot')

</body>
</html>


