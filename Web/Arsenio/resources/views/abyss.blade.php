@extends('template.mainPage')

@section('webTitle', 'Arsenio: Abyss')

@section('mainContent')

<body class="abyss-bg">
    <div class="float-end">
        
        <div class="abyss-parent">
            <img class="mt-3 img-fluid abyss-leaderboard" src="/images/leaderboard.png" alt="Leaderboard" width="350">
            <div class="abyss-text">
            @foreach ($studentPoint as $sp)
                @if ($loop->index < 5)
                    <h4>{{ $loop->index+1 }}. {{ $sp->user->name}} ({{ $sp['abyss_point']}} pt)</h4>   
                @else
                    @break             
                @endif          
            @endforeach
            </div>
        </div>

        <a href="/battle/n/abyss/n/n/{{ $student->characterExp->health }}/t/0/n/25/n"><img class="m-4 img-fluid abyss-btn" src="/images/buttonAbyss.png" alt="button" width="200"/></a>
    
    </div>
    <div>
        <img class="m-5 img-fluid abyss-monster" src="/images/monsterAbyss.png" alt="Monster" width="850">
    </div>
</body>


@endsection