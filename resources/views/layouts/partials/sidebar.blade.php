<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sections.index') }}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Section</span>
            </a>
        </li>
        @if (Auth::user()->is_admin)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="icon-user menu-icon"></i>
                    <span class="menu-title">Users</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
