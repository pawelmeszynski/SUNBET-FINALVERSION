<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
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

        .match {

            text-align: center;
            border: 1px solid black;
            width: 400px;
            border-radius: 6px;
            margin-bottom: 2%;
            padding: 10px;
        }

        h1 {
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
        }

        img {
            height: 30px;
            width: 30px;
        }
    </style>
</head>
<body>
@include('partials.condition')
<div>
    <h1>Current Matches</h1>
    <div>
        @foreach($matches as $match)
{{--                        {{ dd($match->matchday == 1); }}--}}
            <div class="container">
                <div class="match">
                    <form action="{{ route('matches.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                        @if(($homeTeam = $match->homeTeam) && ($awayTeam = $match->awayTeam))
                            <p>{{ $homeTeam->name }}</p> <img src="{{ $homeTeam->crest }}">
                            <p>{{ $awayTeam->name}}</p> <img src="{{ $awayTeam->crest }}">
                            <h4>PREDICT SCORE</h4>
                            <label>Team {{ $homeTeam->name }} goals:</label>
                            <input type="number" name="home_team_goals" id="home_team_goals"></br>
                            @error('home_team_goals')
                            <p>{{ $message}}</p>
                            @enderror
                            <label>Team {{ $awayTeam->name }} goals:</label>
                            <input type="number" name="away_team_goals" id="away_team_goals"></br>
                            @error('away_team_goals')
                            <p>{{ $message}}</p>
                            @enderror
                            <input type="submit">Confirm
                        @else
                            <p>x-y</p>
                        @endif
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
