<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="{{ route('home.index') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="GET" action="{{ route('posts.search') }}">
                @csrf
                <input type="search" name="keyword" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            </form>
            @auth
                <div class="dropdown">
                    <a href="#" class="btn btn-outline-light me-2" data-bs-toggle="dropdown" data-bs-target="#accountDropdown">
                        <i class="fas fa-user"></i> {{ auth()->user()->username }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Update account information</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout.perform') }}">Logout</a></li>
                    </ul>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
                </div>
            @endguest
        </div>
    </div>
</header>
