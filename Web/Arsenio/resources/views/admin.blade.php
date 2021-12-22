@extends('template.adminPage')

@section('webTitle', 'Arsenio: Admin Mode')

@section('mainContent')
    <body class="home-bg">
        <div class="d-flex justify-content-center align-items-center">
            <div class="position-relative admin-controller-bg">
                <img src="/images/Scroll.png" width="1000" height="500">
                <div class="admin-controller">
                    <a href="/gameLogs" class="admin-controller-text"><h3>Lihat game logs & ban user</h3></a>
                    <div class="d-flex ">
                        <a href="{{ route('question.index') }}" class="admin-controller-text"><h3>Lihat pertanyaan</h3></a> 
                        <h3 class="mx-3">|</h3> 
                        <a href="{{ route('question.create') }}" class="admin-controller-text"><h3>Buat pertanyaan</h3></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection

    
