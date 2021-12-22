<nav class="navbar navbar-inverse navbar-fixed-top round-bottom">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="/images/Logo.png" class="logo">
                Arsenio
            </a>
        </div>
        <ul class="nav navbar-nav navbar-center">
            <li>
                <div class="d-flex justify-content-center align-items-center">
                    {{ $page }}
                    @if ($page != 'BERANDA' && $page != 'ADMIN')
                        <a href="{{ $user->role == 'admin' ? '/admin' : route('home.index') }}" class="btn btn-danger home-icon rounded-pill">
                            <i class="fas fa-home text-center"></i>
                        </a>
                    @endif
                </div>
            </li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <div class="d-flex">
        @if ($user->role != 'admin')
                <img src="/images/Gold.png" class="gold">
                <li>{{ $student->golds }}</li>
        @else
                <form action="/logout" method="POST" class="logout mx-1 pt-1">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                
                </form>
                <li class="pt-1">Welcome, Admin {{ $user->name }}</li> 
        @endif
            </div>
        </ul>
        
    </div>
</nav>