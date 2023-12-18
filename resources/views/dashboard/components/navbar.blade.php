<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('profile') }}">
                <i class="fas fa-user"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
