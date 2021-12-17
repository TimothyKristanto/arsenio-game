@extends('template.mainPage')

@section('webTitle', 'Arsenio: Abyss')

@section('mainContent')

<body class="abyss-bg">
    <div class="float-end">
        
        <div class="abyss-parent">
            <img class="mt-3 img-fluid abyss-leaderboard" src="/images/leaderboard.png" alt="Leaderboard" width="280">
            <h3 class="abyss-text1">1. Arsenio</h3>
            <h3 class="abyss-text2">2. Andreas</h3>
            <h3 class="abyss-text3">3. Averill</h3>
            <h3 class="abyss-text4">4. Joey</h3>
            <h3 class="abyss-text5">5. Timothy</h3>
        </div>

        <a href="{{ route('battle.index') }}"><img class="m-4 img-fluid abyss-btn" src="/images/buttonAbyss.png" alt="button" width="160"/></a>
    
    </div>
    <div>
        <img class="m-3 img-fluid abyss-monster" src="/images/monsterAbyss.png" alt="Monster" width="650">
    </div>
</body>


@endsection