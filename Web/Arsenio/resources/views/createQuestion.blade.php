@extends('template.adminPage')

@section('webTitle', 'Arsenio: Create Question')

@section('mainContent')

    <div class="d-flex justify-content-center">
        <form action="{{ route('question.store') }}" method="POST" class="question-form w-50">
            @csrf
            
            <div class="form-group mt-3">
                <label for="question">Pertanyaan</label>
                <input type="text" class="form-control" name="question" id="question" required>
            </div>

            <div class="form-group mt-3">
                <label for="correct_answer">Jawaban benar</label>
                <input type="text" class="form-control" name="correct_answer" id="correct_answer" required>
            </div>

            <div class="form-group mt-3">
                <label for="answer_b">Jawaban opsi 1</label>
                <input type="text" class="form-control" name="answer_b" id="answer_b" required>
            </div>

            <div class="form-group mt-3">
                <label for="answer_c">Jawaban opsi 2</label>
                <input type="text" class="form-control" name="answer_c" id="answer_c" required>
            </div>

            <div class="form-group mt-3">
                <label for="answer_d">Jawaban opsi 3</label>
                <input type="text" class="form-control" name="answer_d" id="answer_d" required>
            </div>

            <div class="form-group mt-3">
                <label for="level_id">Level cerita</label>
                <select name="level_id" id="level_id">
                    <option value="" selected disabled hidden>Pilih level...</option>
                    @foreach ($storyLevels as $storyLevel)
                        <option value="{{ $storyLevel->level_id }}">Level {{ $storyLevel->story_id }}-{{ ($storyLevel->level_id % 10) }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-dark mt-5 text-center brown">
                    Masukkan data
                </button>
            </div>
    </div>

    </form>

@endsection