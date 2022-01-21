<div class="navbar navbar-expand-lg navbar-light garjootop">
    <div class="container">
        <a class="navbar-brand m-auto m-md-0  d-sm-block flex-shrink-0" href="{{ route('home') }}">
            <img src="{{ asset('static/img/logo1.png') }}" width="142" alt="logo">
        </a>

        <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
            <div class="header-top-nav">
                <ul class="d-flex flex-wrap justify-content-center align-items-center justify-content-sm-end list-unstyled mb-0">

                    <li class="top-nav-item ms-4">
                        <a
                            href="carpooling.html"
                            class="btn bg-white text-center px-3 font-weight-bold mybtn btn-sm ms-2 topbtn"
                        >
                            <i class="fas fa-car me-2"></i> Car Pooling</a>
                    </li>

                    <li class="top-nav-item ms-4 text-white d-md-block d-none">
                        <span></span>
                        <a
                            class="top-nav-link text-white"
                            href="review.html"
                        >
                            <i class="fas fa-comment d-block text-center"></i>Review
                        </a>

                    </li>

                    <li class="top-nav-item ms-4 text-white d-md-block d-none">
                        <span></span>
                        <a
                            class="top-nav-link text-white position-relative"
                            href="{{ route('cart') }}"
                        >
                            <i class="fas fa-cart-plus d-block text-center"></i>Cart
                            @if($userCartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $userCartCount }}
                              </span>
                            @endif
                        </a>
                    </li>

                    <li class=" top-nav-item ms-4 d-md-block d-none">
                        <span></span>
                        <a
                            class="top-nav-link text-white position-relative"
                            href="{{ route('wishlist') }}"
                        >
                            <i class="fas fa-heart d-block text-center"></i> Wishlist
                            @if($userWishlistCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $userWishlistCount }}
                              </span>
                            @endif
                        </a>
                    </li>

                    <li class=" top-nav-item ms-4 d-md-block d-none">
                        <span></span>
                        <a
                            class="top-nav-link text-white"
                            href="{{ route('store') }}"
                        >
                            <i class="fas fa-store d-block text-center"></i> Store
                        </a>
                    </li>

                    <li class="dropdown top-nav-item ms-4 d-md-none d-block">
                        <a class="top-nav-link text-white" href="#" role="button" id="account" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fas fa-paper-plane d-block text-center"></i>Items
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <!-- dropdown-menu start -->
                        <ul class="dropdown-menu list-unstyled" aria-labelledby="account">
                            <li>
                                <a class="dropdown-item" href="#">Review</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cart') }}">Cart</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('wishlist') }}">Wishlist</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Store</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Post Ad</a>
                            </li>
                        </ul>
                        <!-- dropdown-menu start -->
                    </li>

                    @auth
                        <li class=" top-nav-item ms-4 d-md-block d-none">
                            <span></span>
                            <a
                                class="top-nav-link text-white"
                                href="{{ route('my-ad.add') }}"
                            >
                                <i class="fas fa-share d-block text-center"></i> Post Ad
                            </a>
                        </li>

                        <li class="dropdown top-nav-item ms-4">
                            <a
                                class="top-nav-link text-white"
                                href="#"
                                role="button"
                                id="account"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <i class="fas fa-user d-block text-center"></i>
                                @userName()
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <!-- dropdown-menu start -->
                            <ul class="dropdown-menu list-unstyled" aria-labelledby="account">
                                <li>
                                    <a
                                        class="dropdown-item text-capitalize"
                                        href="{{ route('user.profile') }}"
                                    >
                                        {{ session('activeRole') }}'s Profile
                                    </a>
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('user.profile.changePassword') }}"
                                    >
                                        Change Password
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                @role('buyer')
                                <li>
                                    @if(auth()->user()->company_name)
                                        <a
                                            class="dropdown-item"
                                            href="{{ route('user.account.switch') }}"
                                            onclick="event.preventDefault(); document.getElementById('switch-form').submit();"
                                        >
                                            Switch Account
                                        </a>
                                        <form id="switch-form" action="{{ route('user.account.switch') }}" method="POST"
                                              class="d-none">
                                            @csrf
                                        </form>
                                    @else
                                        <a
                                            class="dropdown-item"
                                            data-bs-toggle="modal"
                                            data-bs-target="#switchAccountModal"
                                        >
                                            Switch Account
                                        </a>
                                    @endif
                                </li>
                                @endrole

                                <li>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#pauseAccountModal">
                                        Pause Account
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    >
                                        {{ __('auth.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>

                            </ul>
                            <!-- dropdown-menu start -->
                        </li>
                    @else
                        <li class=" top-nav-item ms-4">
                            <span></span>
                            <a class="top-nav-link text-white" href="{{ route('login') }}">
                                <i class="fas fa-user d-block text-center text-center"></i> Login
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </div>
</div>
