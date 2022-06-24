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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('partials.condition')
<div>
    <h1>Current Matches</h1>
    <div>
        <form action="{{ route('matches.create') }}" method="POST">
            <button type="submit" class="btn btn-success">Confirm</button>
            @foreach($matches as $match)
                <div class="container">
                    <div class="match">
                        @csrf
                        @if(($homeTeam = $match->homeTeam) && ($awayTeam = $match->awayTeam))
                            <p>{{ $homeTeam->name }}</p> <img src="{{ $homeTeam->crest }}">
                            <p>{{ $awayTeam->name}}</p> <img src="{{ $awayTeam->crest }}">
                            <h4>PREDICT SCORE</h4>
                            <label>Team {{ $homeTeam->name }} goals:</label>
                            <input type="number" name="matches[{{ $match->id }}][home_team_goals]"
                                   id="home_team_goals"></br>
                            @error('home_team_goals')
                            <p>{{ $message}}</p>
                            @enderror
                            <label>Team {{ $awayTeam->name }} goals:</label>
                            <input type="number" name="matches[{{ $match->id }}][away_team_goals]"
                                   id="away_team_goals"></br>
                            @error('away_team_goals')
                            <p>{{ $message}}</p>
                            @enderror
                        @endif
                    </div>
                </div>
            @endforeach
        </form>
    </div>
    {{ $matches->links() }}
</div>
</body>
</html>
