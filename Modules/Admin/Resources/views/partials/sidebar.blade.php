<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="overflow-y: scroll;">
    <div class="position-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Overview</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>
                    Dashboard
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>User Management</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Buyers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Sellers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Switched Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Login Log
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Business Management</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Stores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/category*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.category.index') }}">
                    <i class="fa fa-th-large"></i>
                    Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/attribute*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.attribute.index') }}">
                    <i class="fa fa-th-large"></i>
                    Attributes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Classified Ads
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Advertisements</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    General
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Category Specific
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>General</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/country*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.country.index') }}">
                    <i class="fa fa-flag"></i>
                    Country
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    FAQs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/faq*')) ? 'active' : '' }}" aria-current="page"
                   href="{{ route('admin.faq.index') }}">
                    <i class="fa fa-comments"></i>
                    Enquiries
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-cogs"></i>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</nav>
