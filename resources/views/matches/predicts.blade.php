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

    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('partials.condition')
<div>
    <h1>Current Matches</h1>
    <div>
        @foreach($matches as $match)
            <div class="container">
                <div class="match">
                    @foreach($predicts as $predict)
                        <form action="{{ route('matches.predicts') }}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="match_id" value="{{ $match->id }}">
                            @if(($match->id == $predict->match_id))
                                <h3>Your prediction:</h3>
                                <p>Team {{ $homeTeam = $match->homeTeam->name}} goals: {{ $predict->home_team_goals }}</p>
                                <p>Team {{ $awayTeam = $match->awayTeam->name}} goals: {{ $predict->away_team_goals }}</p>
                            @elseif(($match->status == 'FINISHED'))
                                <h3>Final score</h3>
                                <p>Team {{ $homeTeam = $match->homeTeam->name}} goals: {{ $match->home }}</p>
                                <p>Team {{ $awayTeam = $match->awayTeam->name}} goals: {{ $match->away }}</p>
                            @else
                            @endif
                        </form>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
