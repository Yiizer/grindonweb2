<div class="d-flex align-items-stretch">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

      
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center justify-content-center">
    <div class="avatar">
        <img src="{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle">
    </div>
    <div class="title text-center">
        <h1 class="h5">Admin</h1>
        <p>CEO</p>
    </div>
</div>

<style type="text/css">

.sidebar-header {
    display: flex;
    justify-content: center; /* Keep it centered */
    align-items: center; /* Align items vertically */
    margin-left: -10px; /* Move the whole header slightly to the left */
}

.sidebar-header .title {
    text-align: center; /* Center the text */
    margin-left: -10px; /* Optional: Add some space between the avatar and text */
}



</style>
        <span class="heading" style="color: white; margin-top: 10px;">Main</span>

        <ul class="list-unstyled">
                <li><a href="{{url('admin/dashboard')}}"> <i class="icon-home"></i>Home </a></li>
                <li>
                    <a href="{{url('view_category')}}"> <i class="icon-grid"></i>Category </a>
                </li>
                
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_product')}}">Add Product</a></li>
                    <li><a href="{{url('view_product')}}">View Product</a></li>
                    
                  </ul>
                </li>

                <li>
                    <a href="{{url('view_orders')}}"> <i class="icon-grid"></i>Orders </a>
                </li>

                <li>
                  <a href="{{url('completed_orders')}}"> <i class="icon-check"></i>Completed Orders </a>
              </li> 

                <li>
                    <a href="{{ url('admin/messages') }}"> <i class="fa fa-envelope"></i>Messages </a>
                </li>
                
        </ul>
      </nav>