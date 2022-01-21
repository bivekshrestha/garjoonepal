<div class="flex-shrink-0 p-3 bg-white">
    <div class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <img src="{{ asset('static/site/profile.png') }}" class="img-thumbnail rounded-circle" alt="profile"
             width="50"
             height="50">
        <div class="d-flex flex-column ms-3 text-capitalize">
            <div class="fw-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
            <small>{{ session('activeRole') }}</small>
        </div>
    </div>
    <ul class="list-unstyled ps-0">

        @role('seller')
        @if(session('activeRole') == 'seller')
            <li class="mb-1">
                <button
                    class="btn btn-toggle menu_toggle align-items-center rounded collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#home-collapse" aria-expanded="false"
                >
                    My Ads
                </button>
                <div class="collapse {{ (request()->is('profile/my-ad*')) ? 'show' : '' }}" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li>
                            <a
                                href="{{ route('my-ad.index') }}"
                                class="link-dark rounded {{ (request()->is('profile/my-ad')) ? 'link-app-primary' : '' }}"
                            >
                                Overview
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route('my-ad.add') }}"
                                class="link-dark rounded {{ (request()->is('profile/my-ad/add') || request()->is('profile/my-ad/create')) ? 'link-app-primary' : '' }}"
                            >
                                Add New
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="border-top my-3"></li>

            @if(auth()->user()->store)
                <li class="mb-1">
                    <button
                        class="btn menu_toggle btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#dashboard-collapse"
                        aria-expanded="{{ (request()->is('profile/my-store*')) ? 'true' : 'false' }}"
                    >
                        My Store
                    </button>

                    <div
                        class="collapse {{ (request()->is('profile/my-store*')) || (request()->is('profile/my-product*')) ? 'show' : '' }}"
                        id="dashboard-collapse"
                    >
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li>
                                <a
                                    href="{{ route('my-store.index') }}"
                                    class="link-dark rounded {{ (request()->is('profile/my-store')) ? 'link-app-primary' : '' }}"
                                >
                                    Overview
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('my-product.index') }}"
                                    class="link-dark rounded {{ (request()->is('profile/my-product')) ? 'link-app-primary' : '' }}"
                                >
                                    My Products
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('my-product.draft.index') }}"
                                    class="link-dark rounded {{ (request()->is('profile/my-product/in-draft')) ? 'link-app-primary' : '' }}"
                                >
                                    Products in Draft
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('my-product.create') }}"
                                    class="link-dark rounded {{ (request()->is('profile/my-product/create')) ? 'link-app-primary' : '' }}"
                                >
                                    Add New Product
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            @else
                <li class="mb-1">
                    <a
                        class="btn btn-toggle align-items-center rounded collapsed {{ (request()->is('my-store/*')) ? 'active' : '' }}"
                        href="{{ route('my-store.create') }}"
                    >
                        Build Your Store
                    </a>
                </li>
            @endif
            <li class="border-top my-3"></li>
        @endif
        @endrole
        <li class="mb-1">
            <button
                class="btn btn-toggle menu_toggle align-items-center rounded collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#orders-collapse"
                aria-expanded="false"
            >
                My Orders & Bookings
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded">Orders</a></li>
                    <li><a href="#" class="link-dark rounded">Bookings</a></li>
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button
                class="btn btn-toggle menu_toggle align-items-center rounded collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#account-collapse"
                aria-expanded="{{ (request()->is('profile*')) ? 'true' : 'false' }}"
            >
                My Account
            </button>
            <div class="collapse {{ (request()->is('profile*')) ? 'show' : '' }}" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a
                            href="{{ route('user.profile') }}"
                            class="link-dark rounded {{ (request()->is('profile')) ? 'link-app-primary' : '' }}"
                        >
                            Profile
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('user.profile.changePassword') }}"
                            class="link-dark rounded {{ (request()->is('profile/change-password')) ? 'link-app-primary' : '' }}"
                        >
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ route('user.2fa') }}"
                            class="link-dark rounded {{ (request()->is('profile/account/2fa')) ? 'link-app-primary' : '' }}"
                        >
                            Two Factor Authentication
                        </a>
                    </li>
                    <li>
                        <a
                            href="#" class="link-dark rounded"
                        >
                            Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
