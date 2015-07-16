<!doctype html>
<html>
<head>
    @yield('title')
    <link rel="stylesheet" type="text/css" href="/vendor/sun/auth/css/auth.css">
    <link rel="icon" type="image/png" href="{{ Config::get('SunAuth.app.favicon-url') }}">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>

    @yield('content')

</body>
</html>
