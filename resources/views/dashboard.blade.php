<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>mobile</th>
        </tr>
        <tbody>
            @foreach (db()->table('users')->get() as $key => $value)
                <tr>
                    <td>{{ $key +1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- @if(hasSession('user_id'))
        {{ getAuthUser() }}
    @endif -->

    <!-- {{ session()->get('user_id') }} -->

    <!-- @dd(db()->table('users')->where('id', 1)->first()->name) -->
</body>
</html>