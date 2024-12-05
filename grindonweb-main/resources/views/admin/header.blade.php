<header class="header">
  <nav class="navbar navbar-expand-lg" style="background-color: #333; padding: 10px;">
    <div class="search-panel">
      <div class="search-inner d-flex align-items-center justify-content-center">
        <div class="close-btn text-white" style="cursor: pointer; font-size: 16px;">Close <i class="fa fa-close"></i></div>
        <form id="searchForm" action="#" style="display: flex; align-items: center;">
          <div class="form-group" style="display: flex; align-items: center;">
            <input type="search" name="search" placeholder="What are you searching for..." style="background-color: #444; color: white; border: 1px solid #696969; padding: 8px; border-radius: 4px; width: 200px;">
            <button type="submit" class="submit" style="background-color: #444; color: white; border: 1px solid #696969; padding: 8px 12px; margin-left: 10px; border-radius: 4px; cursor: pointer;">
              Search
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header d-flex align-items-center">
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
        <button class="sidebar-toggle" style="color: white; background-color: #444; border: none; padding: 0; width: 40px; height: 40px; border-radius: 50%; display: flex; justify-content: center; align-items: center; cursor: pointer; line-height: 0;">
  <i class="fa fa-long-arrow-left" style="font-size: 18px;"></i>
</button>

      </div>

      <!-- Logout as Icon -->
      <div class="list-inline-item logout">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-logout-icon" style="background: none; border: none; color: white; font-size: 20px; cursor: pointer; transition: color 0.3s ease;">
            <i class="fa fa-sign-out"></i> <!-- Font Awesome Icon -->
          </button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Inline CSS for Logout Icon -->
  <style>
    /* Close button style */
    .close-btn {
      color: white;
      cursor: pointer;
      font-size: 16px;
    }

    /* Logout button hover */
    .btn-logout-icon:hover {
      color: #ff4d4d; /* Red hover color */
    }

    .btn-logout-icon:focus {
      outline: none; /* Remove focus outline */
    }

    /* Logo display (show large logo by default, small on small screens) */
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

    /* Search panel styles */
    .search-panel {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      background-color: rgba(0, 0, 0, 0.7);
      height: 100vh;
      display: none;
    }

    .search-inner {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #333;
      padding: 20px;
      border-radius: 5px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .search-inner input {
      background-color: #444;
      color: white;
      border: 1px solid #696969;
      padding: 8px;
      border-radius: 4px;
      margin-bottom: 10px;
    }

    .search-inner button {
      background-color: #444;
      color: white;
      border: 1px solid #696969;
      padding: 8px 12px;
      border-radius: 4px;
      cursor: pointer;
    }

    .search-inner button:hover {
      background-color: #555;
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
