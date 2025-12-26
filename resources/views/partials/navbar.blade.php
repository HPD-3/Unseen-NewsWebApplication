<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand fw-bold fs-4 text-uppercase me-4"
           href="{{ url('/articles') }}">
            UNSEEN
        </a>

        <!-- Mobile toggle -->
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <!-- Primary navigation -->
            <ul class="navbar-nav mx-auto text-uppercase fw-semibold gap-lg-4">
                <li class="nav-item">
                    <a class="nav-link px-2" href="{{ url('/articles') }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2" href="{{ url('/articles?type=news') }}">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2" href="{{ url('/articles?type=feature') }}">Feature</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2" href="{{ url('/articles?type=opinion') }}">Opinion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2" href="{{ url('/articles?type=analysis') }}">Analysis</a>
                </li>
            </ul>

            <!-- Search -->
            <form method="GET" action="{{ url('/articles') }}"
      class="d-flex align-items-center ms-lg-4">

    <input type="search"
           name="q"
           class="form-control form-control-sm bg-dark text-light border-secondary d-none d-lg-block me-2"
           placeholder="Search..."
           value="{{ request('q') }}">

    <button class="btn btn-sm btn-outline-light" type="submit" title="Search">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
             fill="currentColor" class="bi bi-search">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0
                     1.415-1.414l-3.85-3.85zm-5.242.656a5 5 0 1 1
                     0-10 5 5 0 0 1 0 10z"/>
        </svg>
    </button>
</form>

        </div>
    </div>
</nav>

<!-- Region bar -->
<div class="bg-dark border-bottom border-secondary">
    <div class="container">
        <div class="d-flex flex-wrap gap-3 py-2 text-uppercase small fw-semibold">
            <a href="{{ url('/articles?continent=Africa') }}" class="text-light text-decoration-none">Africa</a>
            <a href="{{ url('/articles?continent=Asia') }}" class="text-light text-decoration-none">Asia</a>
            <a href="{{ url('/articles?continent=Europe') }}" class="text-light text-decoration-none">Europe</a>
            <a href="{{ url('/articles?continent=Middle East') }}" class="text-light text-decoration-none">Middle East</a>
            <a href="{{ url('/articles?continent=Americas') }}" class="text-light text-decoration-none">Americas</a>
        </div>
    </div>
</div>
