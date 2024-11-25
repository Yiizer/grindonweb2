<header class="header">   
  <nav class="navbar navbar-expand-lg">
    <div class="search-panel">
      <div class="search-inner d-flex align-items-center justify-content-center">
        <div class="close-btn">Close <i class="fa fa-close"></i></div>
        <form id="searchForm" action="#">
          <div class="form-group">
            <input type="search" name="search" placeholder="What are you searching for...">
            <button type="submit" class="submit">Search</button>
          </div>
        </form>
      </div>
    </div>
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header">
        <!-- Navbar Header-->
        <a href="{{url('admin/dashboard')}}" class="navbar-brand">
          <div class="brand-image" id="logo-image">
            <img src="{{asset('images/Logo/grindlogo.png')}}" alt="GrindOn Logo" width="150" height="auto">
          </div>

          <div class="brand-image" id="logo-small-image">
            <img src="{{ asset('images/Logo/Glogo.png') }}" alt="GO Logo" width="50" height="auto">
          </div>
        </a>
        <!-- Sidebar Toggle Btn-->
        <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
      </div>
      
      <!-- Logout as Icon -->
      <div class="list-inline-item logout">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-logout-icon">
            <i class="fa fa-sign-out"></i> <!-- Font Awesome Icon -->
          </button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Inline CSS for Logout Icon -->
  <style>
    .btn-logout-icon {
      background: none; /* No background */
      border: none; /* No border */
      color: white; /* Icon color */
      font-size: 20px; /* Icon size */
      cursor: pointer; /* Pointer cursor for interactivity */
      transition: color 0.3s ease; /* Smooth hover effect */
    }

    .btn-logout-icon:hover {
      color: #ff4d4d; /* Red hover color */
    }

    .btn-logout-icon:focus {
      outline: none; /* Remove focus outline */
    }

    /* Initially, show the large logo for GRINDON */
#logo-image {
    display: block;
}

#logo-small-image {
    display: none;
}

/* Optional: On smaller screens, hide the large logo and show the small one */
@media (max-width: 768px) {
    #logo-image {
        display: none;
    }
    #logo-small-image {
        display: block;
    }
}

/* Optional: Smooth transition for logo fade */
#logo-image, #logo-small-image {
    transition: opacity 0.3s ease-in-out;
}

  </style>

<script>
    // JavaScript function to toggle logo visibility
    function toggleLogo() {
        const logoImage = document.getElementById("logo-image");
        const logoSmallImage = document.getElementById("logo-small-image");

        // Toggle visibility of the large and small logos
        if (logoImage.style.display === "none") {
            logoImage.style.display = "block";
            logoSmallImage.style.display = "none";
        } else {
            logoImage.style.display = "none";
            logoSmallImage.style.display = "block";
        }
    }
</script>
</header>
