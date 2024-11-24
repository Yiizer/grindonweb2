<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <!-- User Icon and Name Section -->
        @if (Auth::check())
            <div class="user-info-container">
                <div class="user-info text-center">
                    <i class="fa fa-user-circle" style="font-size: 36px; color: white;"></i>
                    <span class="d-block mt-1 user-name">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        @endif

        <!-- Logo Section -->
        <a class="navbar-brand" href="">
            <img src="{{ asset('images/Logo/grindlogo.png') }}" style="height: 50px; width: auto;">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('shop') }}">Shop</a>
                </li>
                <li class="nav-item {{ Request::is('why') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('why') }}">Why Us</a>
                </li>
                <li class="nav-item {{ Request::is('testimonial') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('testimonial') }}">Testimonial</a>
                </li>
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                </li>
            </ul>

            <div class="user_option">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('myorders') }}">My Orders</a>
                        <a href="{{ url('mycart') }}">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            {{ $count }}
                        </a>
                        <form style="padding: 15px" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input class="btn btn-success" type="submit" value="Logout">
                        </form>
                    @else
                        <a href="{{ url('/login') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{ url('/register') }}">
                            <i class="fa fa-vcard" aria-hidden="true"></i>
                            <span>Register</span>
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
</header>
