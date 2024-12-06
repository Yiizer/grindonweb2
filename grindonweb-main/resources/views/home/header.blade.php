<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <!-- User Icon and Name Section -->
        <!-- @if (Auth::check())
            <div class="user-info-container">
                <div class="user-info text-center">
                    <i class="fa fa-user-circle" style="font-size: 36px; color: white;"></i>
                    <span class="d-block mt-1 user-name">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        @endif -->

        <!-- Logo Section -->
        <a class="navbar-brand" href="">
            <img src="{{ asset('images/Logo/grindlogo.png') }}" style="height: 50px; width: auto; object-fit: contain;">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('shop') || Request::is('product_details*') ? 'active' : '' }}">
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
                <li class="nav-item {{ Request::is('myorders') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('myorders') }}">My orders</a>
                </li>
            
            </ul>


            <div class="user_option">
                @if (Route::has('login'))
                    @auth
                        
                        <a href="{{ url('mycart') }}">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            <span style="color: white;">{{ $count }}</span>
                        </a>
                        <form style="padding: 15px" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input class="logout-btn" type="submit" value="Logout">
                        </form>
                    @else
                        <a href="{{ url('/login') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span style="color: white;">Login</span>
                        </a>
                        <a href="{{ url('/register') }}">
                            <i class="fa fa-vcard" aria-hidden="true"></i>
                            <span style="color: white;">Register</span>
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
</header>

<style>
    .logout-btn {
        background-color: black; /* White background */
        color: white; /* Black text color */
        border: 2px solid #000; /* Black border */
        padding: 10px 20px; /* Padding for the button */
        font-size: 14px; /* Font size */
        text-transform: uppercase; /* Uppercase text */
        cursor: pointer; /* Pointer cursor for hover effect */
        border-radius: 5px; /* Rounded corners */
        transition: all 0.3s ease; /* Smooth transition for hover effect */
        margin-top: 5px; /* Adjust the button downwards */
        margin-left: -10px; /* Adjust the button to the left */
        position: relative; /* Relative positioning for fine control */
    }

    .logout-btn:hover {
        background-color: white; /* Black background on hover */
        color: black; /* White text on hover */
    }
</style>
