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
            justify-content: center;
            text-align: center;
            border: 1px solid black;
            width: 400px;
            border-radius: 6px;
            margin-bottom: 2%;
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

        ul {
            float: left;
            width: 100%;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        li a {
            display: block;
            float: left;
            text-align: center;
            font-size: 0.8em;
            width: 80px;
            text-decoration: none;
            color: aqua;
            background-color: blue;
            padding: 5px 5px;
            margin: 0px 1px 1px 0px;
            border: 1px solid navy;
            border-radius: 3px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            box-shadow: 0px 2px 3px #797777;
            -moz-box-shadow: 0px 2px 3px gray;
            -webkit-box-shadow: 0px 2px 3px gray;
        }

        li a:hover {
            color: blue;
            background: aqua;
            border: 1px solid blue;
        }

        .timed-match {
            color: red;
            justify-content: center;
            text-align: center;
            border: 1px solid black;
            width: 400px;
            border-radius: 6px;
            margin-bottom: 2%;
        }

    </style>
</head>
<body>
@include('partials.condition')
<div>
    <h1>Your Predicts</h1>
    <div>
        <form action="{{ route('matches.predicts') }}" method="POST">
            <div class="container">
                <div class="match">
                    @foreach($matches as $match)
                        @foreach($predicts as $predict)
                            @csrf
                            {{--                            <input type="hidden" name="match_id" value="{{ $match->id }}">--}}
                            @if(($match->id == $predict->match_id)
                            &&($match->status == 'FINISHED')
                            &&($homeTeam = $match->homeTeam)
                            &&($awayTeam = $match->awayTeam))
                                <img src="{{ $homeTeam->crest }}">
                                <img src="{{ $awayTeam->crest }}">
                                <p style="font-size: 20px; color:black; font-weight: bold">
                                    {{ $predict->home_team_goals }} - {{ $predict->away_team_goals }}
                                </p>
                                <h3>Final score:</h3>
                                <p style="font-size: 13px; color:gray">{{ $match->home }} - {{ $match->away }}</p>
                                <div style="background-color:#6b7280; width: 100%; height: 1px;"></div>
                            @endif
                        @endforeach
                    @endforeach

                </div>
            </div>
        </form>
    </div>
    {{ $predicts->links() }}
</div>
</body>
</html>
