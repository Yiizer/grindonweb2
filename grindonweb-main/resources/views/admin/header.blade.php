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
          <div class="brand-text brand-big visible text-uppercase">
            <strong class="text-primary">Grind</strong><strong>On</strong>
          </div>
          <div class="brand-text brand-sm"><strong class="text-primary">G</strong><strong>O</strong></div>
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
  </style>
</header>
