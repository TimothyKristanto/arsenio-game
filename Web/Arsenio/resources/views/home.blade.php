@extends('template.mainPage')

@section('webTitle', 'Arsenio: Homepage')

@section('mainContent')
    <div class="profile rounded-pill">
        <a href="#" class="logout mx-3">
            <i class="fas fa-sign-out-alt"></i>
        </a>
        <h6 class="username">Nama user</h6>
        <h6 class="story-progress">Story progress</h6>
        <h6 class="abyss-score">Abyss Score</h6>
    </div>

@endsection

