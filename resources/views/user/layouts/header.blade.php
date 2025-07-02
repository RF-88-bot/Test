<nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center w-100">

            <div class="col-auto">
                <a class="navbar-brand text-dark" href="#">
                    PAILO
                </a>
            </div>

            <div class="col-auto">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">
                            <li class="nav-item ">
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Request::is('galery*') ? 'active' : '' }}"
                                    href="{{ route('galery') }}">Galery</a>
                            </li>
                            <li class="nav-item">
                                @guest
                                    <a class="nav-link" href="#"
                                        onclick="event.preventDefault(); showToast('😅 Waduh, nggak bisa lihat favorite kalau belum login.')">
                                        Favorite
                                    </a>
                                @endguest
                                @auth
                                    <a class="nav-link {{ Request::is('user/favorite*') ? 'active' : '' }}"
                                        href="{{ route('user.favorite') }}">Favorite</a>
                                @endauth
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('book-with-relation') ? 'active' : '' }}"
                                    href="{{ route('book.relation') }}">Normal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('book-with-N+1-problem') ? 'active' : '' }}"
                                    href="{{ route('book.problem') }}">N + 1</a>
                            </li>
                            <li class="nav-item">
                                @guest
                                    <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                                @endguest
                                @auth
                                    <a class="nav-link" href="{{ route('logout') }}">LOGOUT</a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showToast(message) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }
</script>
