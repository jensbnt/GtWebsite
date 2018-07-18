<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark" role="navigation">
    <a class="navbar-brand" href="{{ route('pages.index') }}">GT Sport</a>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('cars.index') }}" id="carsDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Cars
                </a>
                <div class="dropdown-menu" aria-labelledby="carsDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('cars.index') }}">All</a>
                    <a class="dropdown-item" href="{{ route('cars.new') }}">New</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('stats.index') }}">Stats</a></li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <!-- RIGHT FLOATING LINKDS -->
        </ul>
    </div>
</nav>