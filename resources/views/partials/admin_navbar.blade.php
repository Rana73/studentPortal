<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{route('dashboard')}}">{{Auth::guard('institute')->user()->name}}</a>
    
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Clock-->

    <!-- Navbar Search-->
    <div class="ms-auto d-none d-md-block">
        <form class="form-inline  me-0 me-md-3 my-2 my-md-0">
            <p class="text-white dashboard-date mb-0" id="date"><i class="far fa-clock"></i>&nbsp;<div id="txt" class="text-white">time</div></p>
        </form>
    </div>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img class="profile-img" @if(isset(Auth::user()->image)) src="{{ asset(Auth::user()->image) }}" @else src="{{asset('noimage.png')}}"  @endif alt=""> <span class="common-text">{{Auth::guard('institute')->user()->username}}</span></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{route('password.change')}}"><i class="fa fa-user"></i> Password change</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="return confirm('Are you sure logout from Admin Panel')"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
