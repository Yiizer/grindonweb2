<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
        body {
            background-color: #2c2c2c;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }

        .container-fluid {
            margin-top: 30px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .form-container {
            width: 60%;
            margin: 0 auto;
            padding: 30px;
            background-color: #3a3a3a;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: bold;
            color: #dddddd;
        }

        input[type='text'],
        input[type='number'],
        input[type='file'],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            background-color: #ffffff;
            color: #333333;
            font-size: 14px;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        img {
            display: block;
            width: 150px;
            height: auto;
            margin: 10px 0;
            border-radius: 8px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #28a745;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #218838;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-section {
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
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
        <h2>Update Product</h2>
        
        <div class="form-container">
          <form action="{{url('edit_product',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
              <label>Title</label>
              <input type="text" name="title" value="{{$data->title}}" required>
            </div>

            <div class="form-section">
              <label>Description</label>
              <textarea name="description" required>{{$data->description}}</textarea>
            </div>

            <div class="form-section">
              <label>Price</label>
              <input type="number" name="price" value="{{$data->price}}" step="0.01" required>
            </div>

            <div class="form-section">
              <label>Quantity</label>
              <input type="number" name="quantity" value="{{$data->quantity}}" min="1" required>
            </div>

            <div class="form-section">
              <label>Category</label>
              <select name="category" required>
                <option value="{{$data->category}}">{{$data->category}}</option>
                @foreach($category as $category)
                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-section">
              <label>Current Image</label>
              <img src="/products/{{$data->image}}" alt="Current Product Image">
            </div>

            <div class="form-section">
              <label>New Image</label>
              <input type="file" name="image">
            </div>

            <div class="form-section">
              <button class="btn" type="submit">Update Product</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>
