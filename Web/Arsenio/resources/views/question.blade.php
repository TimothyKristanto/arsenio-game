@extends('template.adminPage')

@section('webTitle', 'Arsenio: Show Questions')

@section('mainContent')
    <div class="d-flex justify-content-center m-2">
        <div class="question-form">
            <table class="table table-striped text-center" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Question</th>
                        <th>Correct answer</th>
                        <th>Customize question</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                @endphp
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $i }}</td>
                            <td class="w-50">{{ $question->question }}</td>
                            <td class="w-25">{{ $question->correct_answer }}</td>
                            <td class="w-50">
                                <a href="{{ route('question.show', $question->question_id) }}" class="btn btn-success">Show</a>
                                <a href="{{ route('question.edit', $question->question_id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('question.destroy', $question->question_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger float-left">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Boostrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            var thetable = $('#table').DataTable({});
        });
    </script>

@endsection