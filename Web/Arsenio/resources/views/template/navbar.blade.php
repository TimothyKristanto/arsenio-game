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
                @if ($page != 'BERANDA')
                    @if ($page == 'STORY MODE' || $page == 'ABYSS')
                        <a href="{{ route('home.index') }}" class="back-icon">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @else
                        <a href="#" onclick="history.back()" class="back-icon">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @endif
                @endif
                {{ $page }}
                @if ($page != 'BERANDA')
                    <a href="{{ route('home.index') }}" class="home-icon">
                        <i class="fas fa-home text-center"></i>
                    </a>
                @endif
                
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