<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ assets('css/style.css') }}">
</head>
<body>
    {{ getData('users') }} <br><br>
    {{ findData('users', 1)['name'] }} <br><br>
    
    {{ $name }}
    <form action="/login" method="post">
        <input type="text" name="email" placeholder="Enter Email ..."><br><br>
        <input type="text" name="password" placeholder="Enter Password ..."><br><br>
        <input type="submit">
    </form>
    
</body>
</html>