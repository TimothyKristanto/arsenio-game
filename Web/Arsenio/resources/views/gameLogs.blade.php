@extends('template.adminPage')

@section('webTitle', 'Arsenio: Lihat game logs & ban user')

@section('mainContent')
    <div class="d-flex justify-content-center m-2">
        <div class="question-form">
            <table class="table table-striped text-center" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Table</th>
                        <th>Student</th>
                        <th>Log desc</th>
                        <th>Log path</th>
                        <th>Log ip</th>
                        <th>Ban user</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                        @foreach ($gameLogs as $gameLog)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $gameLog->table }}</td>
                                <td>User {{ $gameLog->student->user->username }}</td>
                                <td class="w-25">{{ $gameLog->log_desc }}</td>
                                <td>{{ $gameLog->log_path }}</td>
                                <td>{{ $gameLog->log_ip }}</td>
                                <td class="w-25">
                                    <form action="/admin/{{ $gameLog->student_id }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            Ban user
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