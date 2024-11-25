<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
        body {
            background-color: #121212; /* Dark background for the body */
            color: white; /* White text color for contrast */
        }

        input[type='text'] {
            width: 400px;
            height: 50px;
            background-color: #333; /* Dark input background */
            color: white; /* White text inside input */
            border: 1px solid #666; /* Gray border */
            border-radius: 4px;
            padding: 10px;
        }

        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

        .table_deg {
            text-align: center;
            margin: auto;
            border: 2px solid #fff; /* White border for the table */
            margin-top: 50px;
            width: 600px;
            border-collapse: collapse;
            background-color: #222; /* Dark background for the table */
        }

        th {
            background-color: #333; /* Dark background for table headers */
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white; /* White text in the header */
        }

        td {
            color: white;
            padding: 10px;
            border: 1px solid #444; /* Dark gray borders */
        }

        .btn {
            background-color: #555; /* Gray background for buttons */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #777; /* Lighter gray on hover */
        }

        .btn-primary {
            background-color: #333; /* Dark gray for primary button */
        }

        .btn-success {
            background-color: #4CAF50; /* Green for success buttons */
        }

        .btn-danger {
            background-color: #f44336; /* Red for danger buttons */
        }

        .btn-danger:hover, .btn-success:hover {
            background-color: #666; /* Lighter shade for hover effects */
        }

        h1 {
            color: white; /* White text for the title */
            text-align: center;
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

          <h1>Add Category</h1>

          <div class="div_deg">
            <form action="{{url('add_category')}}" method="POST">
              @csrf
              <div>
                <input type="text" name="category" placeholder="Enter Category Name">
                <input class="btn btn-primary" type="submit" value="Add Category">
              </div>
            </form>
          </div>

          <div>
            <table class="table_deg">
              <tr>
                <th colspan="3">Category Name</th>
              </tr>

              @foreach($data as $data)
              <tr>
                <td>{{$data->category_name}}</td>
                <td>
                  <a class="btn btn-success" href="{{url('edit_category',$data->id)}}">Edit</a>
                </td>
                <td>
                  <a class="btn btn-danger" onClick="confirmation(event)" href="{{url('delete_category',$data->id)}}">Delete</a>
                </td>
              </tr>
              @endforeach
            </table>
          </div>

        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>
