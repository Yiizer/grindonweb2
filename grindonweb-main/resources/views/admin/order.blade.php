<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
        table {
            border: 2px solid skyblue;
            text-align: center;
        }

        th {
            background-color: skyblue;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: white;
        }
        
        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        td {
            color: white;
            border: 1px solid skyblue;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h3>All Orders</h3>
          <br>
          <br>
          <div class="table_center">
            <table>
              <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Product Title</th>
                <th>Price</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Payment Status</th>
                <th>Status</th>
                <th>Change Status</th>
                <th>Print PDF</th>
              </tr>

              @foreach($data as $order)  <!-- Updated variable name -->
              <tr>
                  <td>{{ $order->name }}</td>
                  <td>{{ $order->rec_address }}</td>
                  <td>{{ $order->phone }}</td>
                  <td>{{ $order->product->title }}</td>
                  <td>{{ $order->product->price }}</td>
                  <td>{{ $order->size }}</td>  <!-- Display size -->
                  <td>{{ $order->color }}</td>  <!-- Display color -->
                  <td>{{ $order->quantity }}</td>  <!-- Display quantity -->
                  <td>
                      <img width="150" src="products/{{ $order->product->image }}" alt="Product Image">
                  </td>
                  <td>{{ $order->payment_status }}</td>
                  <td>
                      @if($order->status == 'in progress')
                          <span style="color:red">{{ $order->status }}</span>
                      @elseif($order->status == 'On the Way')
                          <span style="color:skyblue">{{ $order->status }}</span>
                      @else
                          <span style="color:green">{{ $order->status }}</span>
                      @endif
                  </td>
                  <td>
                      <a class="btn btn-primary" href="{{ url('on_the_way', $order->id) }}">On The Way</a>
                      <a class="btn btn-success" href="{{ url('delivered', $order->id) }}">Delivered</a>
                  </td>
                  <td>
                      <a class="btn btn-secondary" href="{{ url('print_pdf', $order->id) }}">Print PDF</a>
                  </td>
              </tr>
              @endforeach
          </table>
          </div>
        </div>
      </div>
    </div>
    @include('admin.js')
  </body>
</html>
