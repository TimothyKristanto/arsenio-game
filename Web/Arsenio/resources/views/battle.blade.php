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
    <div id="black-bg" class="black-bg"></div>
    <div class="battle-area">
        @if ($mode == 'abyss')
            <div class="abyss-battle-score d-flex">
                <h1 id="abyss-score-info">Score: {{ $abyssScore }}</h1>
                <span id="score-update" class="score-update mx-4">
                    <p>+250</p>
                </span>
            </div>
        @endif
        
        <button onclick="pauseGame()" class="pause-battle btn btn-danger">
            <i class="fas fa-pause"></i>
        </button>
        <div class="question-countdown">
            <h1><i class="fas fa-hourglass-half"></i></h1> &nbsp; &nbsp;
            <h1 id="countdown">{{ $countdown < 10 ? '0' . $countdown : $countdown }}</h1>
        </div>
        <div id="user-health-deduct" class="user-health-deduct">
            <span>-{{ $enemyAttack }}</span> 
            <i class="fas fa-heart heart-icon"></i>
        </div>
        <img id="battle-character" src="/images/BattleCharacter.png" class="battle-character {{ $firstAnim == 't' ? 'slide-right' : '' }} {{ $battleStatus == 'lose' ? 'lose' : '' }}">
        <div id="enemy-health-deduct" class="enemy-health-deduct">
            <span>-20</span> 
            <i class="fas fa-heart heart-icon"></i>
        </div>
        <img id="battle-enemy" src="{{ $mode == 'story' ? $storyLevel->enemy->image : $enemy->image }}" class="battle-enemy {{ $mode == 'abyss' ? 'monster-abyss' : '' }} {{ $firstAnim == 't' ? 'slide-left' : '' }} {{ $battleStatus == 'win' ? 'lose' : '' }}">
        <div class="character-hp">
            <i class="fas fa-heart heart-icon"></i>
            {{ $userHealth }}
        </div>
        @if($mode == 'story')
            <div class="enemy-hp">
                {{ $enemyHealth * 20 }}
                <i class="fas fa-heart heart-icon"></i>
            </div>
        @endif
        <img src="{{ $mode == 'story' ? '/images/' . $storyLevel->story->image : $abyssBg }}" class="battle-background">
    </div>

    <div id="check-answer" class="check-answer-container justify-content-center">
        <div id="correct-icon" class="correct-answer">
            <i class="fas fa-check-circle"></i>
        </div>
        <div id="wrong-icon" class="wrong-answer">
            <i class="fas fa-times-circle"></i>
        </div>
        <div id="times-up" class="times-up-answer">
            <span>Waktu Habis!</span>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center">
        <div id="pause-alert" class="alert alert-warning alert-dismissible fade show story-desc-alert text-center pause-alert">
            <h2 class="mt-5">Menyerah dari pertarungan?</h2>

            @if ($mode == 'story')
                <div class="d-flex justify-content-end">
                    <a href="/story/{{ $storyLevel->story->story_id }}/f" class="btn btn-danger text-center mt-3">MENYERAH</a>
                </div>
            @else
                <div class="d-flex justify-content-end">
                    <a href="/abyss" class="btn btn-danger text-center mt-3">MENYERAH</a>
                </div>
            @endif
            <button type="button" onclick="continueGame()" class="btn-close" aria-label="Close"></button>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div id="battle-status" class="alert alert-warning alert-dismissible fade show story-desc-alert text-center battle-status-alert">
            <h2 class="mt-5">Hadiah Anda!</h2>

            <br>

            
            @if ($battleStatus == 'win')
                <div class="d-flex justify-content-center my-3">
                    <img src="/images/Gold.png" class="reward-gold mx-2">
                    <h4>x{{ $rewards[0]->reward_amount }}</h4>
                </div>

                <div class="d-flex justify-content-center my-4">
                    <h4 class="reward_exp mx-2">EXP</h4>
                    <h4>x{{ $rewards[1]->reward_amount }}</h4>
                </div>

                <img src="/images/BattleCharacter.png" class="reward-character">
            @else
                <div class="d-flex justify-content-center my-3">
                    <img src="/images/Gold.png" class="reward-gold mx-2">
                    <h4>x{{ $mode == 'abyss' ? $rewards[0] : '0' }}</h4>
                </div>

                <div class="d-flex justify-content-center my-4">
                    <h4 class="reward_exp mx-2">EXP</h4>
                    <h4>x{{ $mode == 'abyss' ? $rewards[1] : '0' }}</h4>
                </div>
                
                @if ($mode == 'abyss')
                    <div class="d-flex justify-content-center my-4">
                        <h4 class="reward_exp mx-2">Score</h4>
                        <h4>x{{ $abyssScore }}</h4>
                    </div>
                @endif
                

                <img src="/images/DownedBattleCharacter.png" class="reward-character">
            @endif

            @if ($mode == 'story')
                <div class="d-flex justify-content-end">
                    @if($battleStatus == 'lose')
                        <span class="text-end mx-3">
                            <a href="/battle/{{ $storyLevel->level_id }}/story/n/n/r/t/n/n/25/n" class="btn btn-danger text-center mt-1">ULANGI</a>
                        </span>
                    @endif

                    <span class="text-end">
                        <a href="/story/{{ $storyLevel->story->story_id }}/f" class="btn btn-danger text-center mt-1">KELUAR</a>
                    </span>
                </div>
            @else
                <span class="d-flex justify-content-end">
                    <a href="/abyss" class="btn btn-danger text-center mt-1">KELUAR</a>
                </span>
            @endif
        </div>
    </div>

    <div class="question-area">
        @if($battleStatus == 'win')
            <div class="pt-3 text-center text-white">
                <h1 class="battle-status">Anda Menang!</h1>
                <h3>Darah musuh telah habis</h3>
            </div>
        @elseif ($battleStatus == 'lose')
            <div class="pt-3 text-center text-white">
                <h1 class="battle-status">Anda Kalah!</h1>
                <h3>Darah karakter Anda telah habis</h3>
            </div>
        @else
            <div class="pt-3 text-center">

                <span class="question">
                    {{ $question }}
                </span>

                <br>

                <button id="answer-a" value="{{ $answers[0] }}" onclick="checkAnswer(this.id)" class="btn btn-answer rounded-pill btn-answer-left">
                    A. {{ $answers[0] }}
                </button>   

                <button id="answer-b" value="{{ $answers[1] }}" onclick="checkAnswer(this.id)" class="btn btn-answer rounded-pill btn-answer-right">
                    B. {{ $answers[1] }}
                </button>  
                
                <br>

                <button id="answer-c" value="{{ $answers[2] }}" onclick="checkAnswer(this.id)" class="btn btn-answer rounded-pill btn-answer-left">
                    C. {{ $answers[2] }}
                </button>  

                <button id="answer-d" value="{{ $answers[3] }}" onclick="checkAnswer(this.id)" class="btn btn-answer rounded-pill btn-answer-right">
                    D. {{ $answers[3] }}
                </button>  
            </div>

            <div class="battle-items">
                <button onclick="changePageWithCountdown({{ $studentItem[0]->item_id }})" class="item btn">
                    <img src="/images/BandageItem.png" width="80" height="80">
                    <h4 class="text-center">{{ $studentItem[0]->item_owned }}</h4>
                </button>
                <button onclick="changePageWithCountdown({{ $studentItem[1]->item_id }})" class="item2 item btn">
                    <img src="/images/JamuItem.png" width="80" height="80">
                    <h4 class="text-center">{{ $studentItem[1]->item_owned }}</h4>
                </button>
                <button onclick="changePageWithCountdown({{ $studentItem[2]->item_id }})" class="item btn">
                    <img src="/images/HourglassItem.png" width="80" height="80">
                    <h4 class="text-center">{{ $studentItem[2]->item_owned }}</h4>  
                </button>
            </div>
        @endif
    </div> 

</body>

<script>
    let second = {{ $countdown }};
    let timer;

    CountDownTimer('countdown');

    if('{{ $battleStatus }}' == 'win' || '{{ $battleStatus }}' == 'lose'){
        clearInterval(timer);
        const battleStatTimeout = setTimeout(showBattleStat, 2500);  
    }

    function changePageWithCountdown(item){
        window.location.href = "/battle/{{ $mode == 'story' ? $levelId : 'n' }}/{{ $mode }}/t/{{ $questionId }}/{{ $userHealth }}/f/{{ $mode == 'abyss' ? $abyssScore : 'n' }}/" + item + "/" + second + "/{{ $battleQuestionId }}";
    }

    function showBattleStat(){
        let blackBg = document.getElementById('black-bg');
        let battleStat = document.getElementById('battle-status');

        blackBg.style.display = 'block';
        battleStat.style.display = 'block';
    }

    function CountDownTimer(id)
    {
        function showRemaining() {
            if(second < 10){
                document.getElementById(id).innerHTML = '0' + second;
            }else{
                document.getElementById(id).innerHTML = second;
            }

            second--;

            if (second < 0) {
                clearInterval(timer);
                let timesUp = document.getElementById('times-up');
                let blackBg = document.getElementById('black-bg');
                let checkAnswer = document.getElementById('check-answer');

                blackBg.style.display = 'block';
                checkAnswer.style.display = 'flex';

                timesUp.style.display = 'flex';
                const wrongTimeout = setTimeout(changePageWithWrongAnswer, 2500);
                return;
            }
            
        }
        timer = setInterval(showRemaining, 1000);
    }

    function pauseGame(){
        clearInterval(timer);

        let dialog = document.getElementById('pause-alert');
        dialog.style.display = 'block';

        let blackBg = document.getElementById('black-bg');
        blackBg.style.display = 'block';
    }

    function continueGame(){
        CountDownTimer('countdown');
        let dialog = document.getElementById('pause-alert');
        dialog.style.display = 'none';

        let blackBg = document.getElementById('black-bg');
        blackBg.style.display = 'none';
    }

    function checkAnswer(id){
        let answer = document.getElementById(id);
        let correctIcon = document.getElementById('correct-icon');
        let wrongIcon = document.getElementById('wrong-icon');
        let blackBg = document.getElementById('black-bg');
        let checkAnswer = document.getElementById('check-answer');
        
        blackBg.style.display = 'block';
        checkAnswer.style.display = 'flex';

        if(answer.value == '{{ $correctAnswer }}'){
            correctIcon.style.display = 'flex';
            const enemyHealthDeduct = setTimeout(showEnemyHealthDeductInfo, 2000);
            const correctTimeout = setTimeout(changePageWithCorrectAnswer, 4500);
        }else{
            wrongIcon.style.display = 'flex';
            const userHealthDeduct = setTimeout(showUserHealthDeductInfo, 2000);
            const wrongTimeout = setTimeout(changePageWithWrongAnswer, 4500);
        }

        clearInterval(timer);

        function showUserHealthDeductInfo(){
            checkAnswer.style.display = 'none';
            wrongIcon.style.display = 'none';

            let userHealthDeduct = document.getElementById('user-health-deduct');
            let battleCharacter = document.getElementById('battle-character');

            userHealthDeduct.style.display = 'block'
            userHealthDeduct.style.zIndex = '1000'
            battleCharacter.style.zIndex = '1000'
        }

        function showEnemyHealthDeductInfo(){
            checkAnswer.style.display = 'none';
            correctIcon.style.display = 'none';

            if('{{ $mode }}' == 'story'){
                let enemyHealthDeduct = document.getElementById('enemy-health-deduct');
                let battleEnemy = document.getElementById('battle-enemy');

                enemyHealthDeduct.style.display = 'block'
                enemyHealthDeduct.style.zIndex = '1000'
                battleEnemy.style.zIndex = '1000'
            }else{
                let scoreUpdate = document.getElementById('score-update');
                let abyssScoreInfo = document.getElementById('abyss-score-info');

                scoreUpdate.style.display = 'block'
                abyssScoreInfo.style.zIndex = '1000'
            }
            
        }
    }

    function changePageWithCorrectAnswer(){
        @php
            $questionId .= '-' . $battleQuestionId
        @endphp
        
        if('{{ $mode }}' == 'story'){
            window.location.href = '/battle/{{ $levelId }}/{{ $mode }}/t/{{ $questionId }}/{{ $userHealth }}/f/n/n/25/n'
        }else if('{{ $mode }}' == 'abyss'){
            window.location.href = '/battle/n/{{ $mode }}/t/n/{{ $userHealth }}/f/{{ $abyssScore }}/n/25/n'
        }
        
    }

    function changePageWithWrongAnswer(){
        if('{{ $mode }}' == 'story'){
            window.location.href = '/battle/{{ $levelId }}/{{ $mode }}/f/{{ $questionId }}/{{ $userHealth }}/f/n/n/25/n'
        }else if('{{ $mode }}' == 'abyss'){
            window.location.href = '/battle/n/{{ $mode }}/f/n/{{ $userHealth }}/f/{{ $abyssScore }}/n/25/n'
        }
    }
</script>

</html>