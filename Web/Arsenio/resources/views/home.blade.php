@extends('template.mainPage')

@section('webTitle', 'Arsenio: Homepage')

@section('mainContent')
    <body class="home-bg">
        <div class="profile rounded-pill">

            <form action="/logout" method="POST" class="logout mx-3">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>   
               
            </form>
    
            <h6 class="username">Nama user</h6>
            <h6 class="story-progress">Story progress</h6>
            <h6 class="abyss-score">Abyss Score</h6>
        </div>

        <div class="home-level-status text-center">
            <h3 class="chara-level-text">Level 1</h3>
            <img src="/images/HomeCharacter.png" class="home-character">
        </div>

        <div id="carouselExampleIndicators" class="carousel slide story-carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="#">
                  <img src="/images/Story1BG.png" class="carousel-image">
                </a>
              </div>
              <div class="carousel-item">
                <img src="/images/Scroll.png" class="carousel-image" alt="Chapter 2">
              </div>
            </div>
            <button class="carousel-control-prev carousel-control" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next carousel-control" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    
        @include('template.footer')
    </body>

@endsection

