<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" role="navigation">
    <a class="navbar-brand" href="{{ route('pages.index') }}">GT Sport</a>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('cars.index') }}">Cars</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('compare.index') }}">Compare</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('stats.index') }}">Stats</a></li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('cars.new') }}">Create</a></li>
            <li class="nav-item"><a class="nav-link" href="">Backup</a></li>
        </ul>
    </div>
</nav>