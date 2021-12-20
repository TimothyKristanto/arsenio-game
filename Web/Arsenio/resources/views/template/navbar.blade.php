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
                    @if ($page != 'BERANDA')
                        <a href="{{ route('home.index') }}" class="btn btn-danger home-icon rounded-pill">
                            <i class="fas fa-home text-center"></i>
                        </a>
                    @endif
                </div>
            </li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <div class="d-flex">
                <img src="/images/Gold.png" class="gold">
                <li>{{ $student->golds }}</li>
            </div>
        </ul>
    </div>
</nav>