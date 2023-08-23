<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini</title>
    <link rel="stylesheet" href="{{ assets('css/style.css') }}">
</head>
<body>
    <h1>header</h1>
        @yield('content')
    <h1>footer</h1>
    <script src="{{ assets('js/htmx.min.js') }}"></script>
    <script src="{{ assets('js/torbolink.js') }}"></script>
</body>
</html>