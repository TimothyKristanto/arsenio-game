@extends('template.adminPage')

@section('webTitle', 'Arsenio: Show question details')

@section('mainContent')
    <div class="d-flex justify-content-center mt-5">
        <div class="question-form w-50 p-3 mt-5">
            <h2 class="card-title">Pertanyaan level {{ (int) ($question->level_id / 10) }}-{{ $question->level_id % 10 }}</h5>
            <div class="d-flex justify-content-center">
                <h5 class="card-content text-center mt-3 fw-bold w-75">{{ $question->question }}</h6>
            </div>
            <br>
            <div class="d-flex">
                Jawaban benar: <h5 class="fw-bold mx-2"> {{ $question->correct_answer }}</h5>
            </div>
            <hr class="solid"></hr>
            <p class="fw-bold">Opsi jawaban lain:</p>
            <p class="card-content">1. {{ $question->answer_b }}</p>
            <p class="card-content">2. {{ $question->answer_c }}</p>
            <p class="card-content">3. {{ $question->answer_d }}</p>
            <a href="{{ route('question.index') }}" class="btn btn-danger float-end rounded-pill">Back</a>
        </div>
    </div>
    

@endsection