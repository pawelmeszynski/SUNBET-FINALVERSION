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
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('partials.condition')
<div>
    <h1>Team list</h1>
    <div>
        @foreach($competitions as $competition)
            @foreach($competition->teams as $comp)
                <div class="match">
                    <table>
                        <tr>
                            <td>{{ $comp->name }} </td>
                            <td><img src="{{ $comp->crest }}"></td>
                        </tr>
                    </table>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
</body>
</html>
