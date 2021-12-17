<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous"
    >
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"
    >
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://kit.fontawesome.com/ff5a4ae61c.js" crossorigin="anonymous"></script>
    <title>Arsenio: Battle</title>
</head>
<body>
    
    <div class="battle-area">
        <a href="#" onclick="history.back()" class="pause-battle btn btn-danger">
            <i class="fas fa-pause"></i>
        </a>
        <div class="question-countdown">
            <h1><i class="fas fa-hourglass-half"></i></h1> &nbsp; &nbsp;
            <h1>20</h1>
        </div>
        <img src="/images/BattleCharacter.png" class="battle-character">
        <img src="/images/MonsterSkeleton.png" class="battle-enemy">
        <div class="character-hp">
            <i class="fas fa-heart heart-icon"></i>
            {{ $userHealth }}
        </div>
        <div class="enemy-hp">
            100
            <i class="fas fa-heart heart-icon"></i>
        </div>
        <img src="{{ $bgBattle }}" class="battle-background">
    </div>

    <div class="question-area">
        <form action="#" method="POST" class="pt-3 text-center">
            @csrf

            <span class="question">
                Dibawah ini adalah anggota-anggota tubuh dari 
                seorang makhluk bernama manusia, terkecuali 
            </span>

            <br>

            <button type="submit" name="answer_a" value="tangan" class="btn btn-answer rounded-pill btn-answer-left">
                A. Tangan
            </button>   

            <button type="submit" name="answer_b" value="mata" class="btn btn-answer rounded-pill btn-answer-right">
                B. Mata
            </button>  
            
            <br>

            <button type="submit" name="answer_c" value="hidung" class="btn btn-answer rounded-pill btn-answer-left">
                C. Hidung
            </button>  

            <button type="submit" name="answer_d" value="pedang" class="btn btn-answer rounded-pill btn-answer-right">
                D. Pedang
            </button>  
        </form>

        <div class="battle-items">
            <div class="item">
                <img src="/images/BandageItem.png" width="80" height="80">
                <h4 class="text-center">0</h4>
            </div>
            <div class="item2 item">
                <img src="/images/HourglassItem.png" width="80" height="80">
                <h4 class="text-center">0</h4>
            </div>
            <div class="item">
                <img src="/images/JamuItem.png" width="80" height="80">
                <h4 class="text-center">0</h4>  
            </div>
        </div>
    </div> 

</body>
</html>