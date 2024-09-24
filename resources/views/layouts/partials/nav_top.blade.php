<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: gray">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" style="color: #000" href="{{ route('sections.index') }}"><strong>University Project Mate</strong></a>
        <a class="navbar-brand brand-logo-mini" style="color: #000" href="{{ route('sections.index') }}"><strong>UPM</strong></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                    data-toggle="dropdown" aria-expanded="false">
                    <i class="icon-user mx-0"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="messageDropdown">

                    <a href="{{ route('users.show', Auth::user()->id) }}" class="dropdown-item preview-item">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item preview-item">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            Sign Out
                        </button>
                    </form>
                    {{-- <a class="dropdown-item preview-item">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        Sign Out
                    </a> --}}
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
