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

    input[type='search']
    {
      width: 500px;
      height: 60px;
      margin-left: 50px;
    }

    </style>

  </head>
  <body>
    @include('admin.header')
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <form action="{{url('product_search')}}" method="get">
            @csrf
            <input type="search" name="search">
            <input type="submit" class="btn btn-secondary" value+="Search">
          </form>


            <div class="div_deg">

            <table>
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
            <td>{{ $item->description }}</td>
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
                <a href="{{ url('edit_product', $item->id) }}" class="btn edit">Edit</a>
                <form action="{{ url('delete_product', $item->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
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
            
            <div class="div_deg">

            {{$product->links()}}

            </div>

        </div>
      </div>
    </div>
@include('admin.js')
  </body>
</html>