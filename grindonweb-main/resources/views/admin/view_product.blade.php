<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">

    .div_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;
    }

    .table_deg{
        border: 2px solid white;
    }

    th{
        background-color: black;
        color: white;
        font-size: 19px;
        font-weight: bold;
        padding: 15px;
    }

    td{
        border: 1px solid white;
        text-align: center;
        color: white;
    }

    input[type='search'] {
        width: 500px;
        height: 60px;
        margin-left: 50px;
    }

/* Standardized Button Styling */
.btn {
    display: inline-block;
    padding: 12px 25px; /* Adjust button height and width (increase padding for more space) */
    font-size: 14px; /* Adjust font size for better readability */
    text-transform: uppercase;
    border-radius: 4px; /* Rounded corners for consistency */
    text-decoration: none;
    color: #ffffff;
    border: 2px solid transparent; /* Uniform border size */
    box-sizing: border-box; /* Ensure consistent sizing */
    text-align: center; /* Center-align the button text */
    margin-right: 10px; /* Add spacing between buttons */
}

/* Edit Button */
.btn-edit {
    background-color: black; /* Black background for Edit */
    border-color: white;
}

.btn-edit:hover {
    background-color: #555555; /* Gray background on hover */
    border-color: white;
}

/* Delete Button */
.btn-delete {
    background-color: black; /* Black background for Delete */
    border-color: white;
}

.btn-delete:hover {
    background-color: #555555; /* Gray background on hover */
    border-color: white;
}

/* Search Button */
.btn-search {
    background-color: black; /* Black background for Search */
    border-color: white;
    margin-left: 10px; /* Move the search button a little to the left */
}

.btn-search:hover {
    background-color: #555555; /* Gray background on hover */
    border-color: white;
}
form {
    display: flex;
    align-items: center;
    margin-top: 20px; /* Adjust this value to move the form down */
}

input[type='search'] {
    width: 400px;
    height: 50px;
    background-color: #333; /* Dark input background */
    color: white; /* White text inside input */
    border: 1px solid #666; /* Gray border */
    border-radius: 4px;
    padding: 10px;
    margin-right: 10px; /* Space between search box and button */
}

/* Adjust button vertical positioning */
.actions .btn {
    margin-top: -10px; /* Adjust this value as needed */
}


    </style>

  </head>
  <body>
    @include('admin.header')
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="container-fluid">

        <form action="{{url('product_search')}}" method="get">
    @csrf
    <input type="search" name="search" placeholder="Search products...">
    <input type="submit" class="btn btn-search" value="Search">
</form>


            <div class="div_deg">

            <table class="table_deg">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Small</th>
            <th>Medium</th>
            <th>Large</th>
            <th>X Small</th>
            <th>X Large</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{!!Str::limit($item->description,50)!!}</td>
            <td>PHP {{ number_format($item->price, 2) }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->small }}</td>
            <td>{{ $item->medium }}</td>
            <td>{{ $item->large }}</td>
            <td>{{ $item->x_small }}</td>
            <td>{{ $item->x_large }}</td>
            <td>
                @if($item->image)
                    <img src="{{ asset('products/' . $item->image) }}" alt="Product Image" style="width: 100px; height: auto;">
                @else
                    No Image
                @endif
            </td>
            <td class="actions">
    <a href="{{ url('edit_product', $item->id) }}" class="btn btn-edit">Edit</a>
    <form action="{{ url('delete_product', $item->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
    </form>
</td>

        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="pagination-links">
    {{ $product->links() }}
</div>

                
            </div>  
        </div>
    </div>
    @include('admin.js')
  </body>
</html>
