<nav class="navbar navbar-inverse navbar-fixed-top round-bottom">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="/images/Logo.png" class="logo">
                Arsenio
            </a>
        </div>
        <ul class="nav navbar-nav navbar-center">
            <li>{{ $page }}</li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <div class="d-flex">
                <img src="/images/Gold.png" class="gold">
                <li>Jumlah Gold</li>
            </div>
        </ul>
    </div>
</nav>