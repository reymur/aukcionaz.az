

<nav id="navbar" class="navbar navbar-expand-lg bg-white pt-3 pb-3 pt-lg-2 pt-xl-2 pb-lg-2 pb-xl-2">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="green" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>

        <div class="justify-content-center">
            <a class="navbar-brand fs-4 fw-bolder ms-lg-5 ms-xl-5" href="/">
                {{ config('app.name', 'Auksionaz.az') }}
            </a>
        </div>

        <!-- NEW ANNOUBCE ADD BUTTON -->
        @include('announce.buttons.new_announce_add_buton')


        <div class="offcanvas offcanvas-start w-75" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header border border-bottom-1">
                <div class="col fw-bolder">
                    AZ
                </div>
                <div class="col text-center">
                    <a class="navbar-brand fs-4 fw-bolder" href="{{ env('APP_URL') }}">
                        {{ config('app.name', 'Aukcionaz.az') }}
                    </a>
                </div>
                <div class="col text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>

            <div class="offcanvas-body pt-0">
                <ul class="col navbar-nav justify-content-end flex-grow-1 pe-3">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="col-sm-12 col-md-12 col-lg-2 nav-item py-2 d-flex justify-content-end">
                        <div class="col-sm-1 col-md-1 col-lg-2 mb-1 align-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-check-fill opacity-50" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </div>

                        <a class="col-sm-11 col-md-11 col-lg-4 ps-lg-0 nav-link fs-5" href="{{ route('login') }}">{{ __('Giriş') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="col-sm-12 col-md-12 col-lg-2 nav-item py-2 d-flex justify-content-end">
                        <div class="col-sm-1 col-md-1 col-lg-2 mb-1 align-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-plus-fill opacity-50" viewBox="0 0 16 16">
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </div>

                        <a class="col-sm-11 col-md-11 col-lg-10 nav-link ps-lg-0 fs-5" href="{{ route('register') }}">{{ __('Reqisrasiya') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item py-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-black fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                {{ __('Çıxış') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>
