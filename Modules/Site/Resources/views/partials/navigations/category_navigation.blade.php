<nav class="navbar navbar-expand-lg navbar-dark bg-primary mainnav shadow border-bottom">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mymenu" id="main_nav">
            <ul class="navbar-nav m-auto">
                @foreach($categoryTree as $tree)
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="@if ($tree->slug == 'market') {{ route('product.filter') }} @else {{ route('ad.filter', $tree->slug) }} @endif"
                            data-bs-toggle="dropdown"
                        >
                            <i class="{{ $tree->icon }}"></i> {{ $tree->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if($tree->descendants->count() > 0)
                                @foreach($tree->descendants as $child)
                                    @if($child->descendants->count() > 0)
                                        <li class="has-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#"> {{ $child->name }}</a>
                                            <div class="megasubmenu dropdown-menu">
                                                <div class="row">
                                                    @foreach($child->descendants as $grandChild)
                                                        <div class="col-md-4 py-1">
                                                            <a href="#"> {{ $grandChild->name }}</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="#"
                                            >
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- navbar-collapse.// -->
    </div>
    <!-- container-fluid.// -->
</nav>
