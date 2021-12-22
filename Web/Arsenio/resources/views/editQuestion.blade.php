@extends('template.adminPage')

@section('webTitle', 'Arsenio: Create Question')

@section('mainContent')

    <div class="d-flex justify-content-center">
        <form action="{{ route('question.update', $question->question_id) }}" method="POST" class="question-form w-50">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            
            <div class="form-group mt-3">
                <label for="question">Pertanyaan</label>
                <input type="text" class="form-control" name="question" id="question" value="{{ $question->question }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="correct_answer">Jawaban benar</label>
                <input type="text" class="form-control" name="correct_answer" id="correct_answer" value="{{ $question->correct_answer }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="answer_b">Jawaban opsi 1</label>
                <input type="text" class="form-control" name="answer_b" id="answer_b" value="{{ $question->answer_b }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="answer_c">Jawaban opsi 2</label>
                <input type="text" class="form-control" name="answer_c" id="answer_c" value="{{ $question->answer_c }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="answer_d">Jawaban opsi 3</label>
                <input type="text" class="form-control" name="answer_d" id="answer_d" value="{{ $question->answer_d }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="level_id">Level cerita</label>
                <select name="level_id" id="level_id">
                    @foreach ($storyLevels as $storyLevel)
                        @if ($question->level_id == $storyLevel->level_id) 
                            <option value="{{ $storyLevel->level_id }}" selected>Level {{ $storyLevel->story_id }}-{{ $storyLevel->level_id % 10 }}</option>
                        @else
                            <option value="{{ $storyLevel->level_id }}">Level {{ $storyLevel->story_id }}-{{ ($storyLevel->level_id % 10) }}</option>
                        @endif
                        
                    @endforeach
                </select>
            </div>
    
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-dark mt-5 text-center brown">
                    Perbaharui data
                </button>
            </div>
    </div>

    </form>

@endsection