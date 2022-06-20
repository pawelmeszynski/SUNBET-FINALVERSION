<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        img {
            height: 30px;
            width: 30px;
        }
        .match {
            display: flex;
            justify-content: center;
        }
        h1 {
            text-align: center;
        }

    </style>
</head>
<body>
@include('partials.condition')
<div>
    <h1>Team list</h1>
    <div>
        @foreach($teams as $team)
            <div class="match">
                <table>
                    <tr>
                        <td>{{ $team->name }} </td>
                        <td><img src="{{ $team->crest }}"></td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
