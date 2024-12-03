<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">
    body {
        font-family: Arial, sans-serif;
        background-color: #555; /* Change body background color to #555 */
    }

    .admin{
            background-color: rgb(34, 37, 42, 255);
        }

    .page-content {
        padding: 20px;
        background-color: #555; /* Keep page content background white */
        border-radius: 8px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        max-width: 1200px;
    }

    .page-header h3 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
        background-color: #ffffff; /* Keep table background white */
        border-radius: 8px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #d1d1d1;
    }

    th {
        background-color: #333333;
        color: #ffffff;
        text-transform: uppercase;
    }

    td {
        color: #333333;
    }

    td img {
        width: 100px;
        border-radius: 4px;
    }

    /* Standardized Button Styling */
    .btn {
        display: inline-block;
        padding: 10px 20px; 
        font-size: 14px;
        text-transform: uppercase;
        border-radius: 4px;
        text-decoration: none;
        color: #ffffff;
        border: 2px solid transparent; 
        margin-right: 10px;
        box-sizing: border-box; 
        width: 120px;
        text-align: center; 
    }

    .btn-primary, .btn-success, .btn-secondary {
        background-color: black;
        border-color: white;
    }

    .btn-primary:hover, .btn-success:hover, .btn-secondary:hover {
        background-color: #555555;
        border-color: white;
    }

    td span {
        padding: 4px 8px;
        font-size: 14px;
        color: white;
        background-color: transparent;
        border: none;
    }

    td span[style="color:red"] {
        background-color: #e74c3c;
    }

    td span[style="color:skyblue"] {
        background-color: #3498db;
    }

    td span[style="color:green"] {
        background-color: #2ecc71;
    }

    td img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        th, td {
            font-size: 12px;
            padding: 8px;
        }

        .btn {
            font-size: 12px;
            padding: 6px 10px;
        }
    }
</style>

</head>

<body class="admin">
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <h3>Orders</h3>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr> 
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Logo</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Payment Method</th>
                        <th>Ref#</th>
                        <th>Status</th>
                        <th>Change Status</th>
                        <th>Print PDF</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($data as $order)
    <tr>
    <td>{{ $order->name }}</td>
    <td>{{ $order->rec_address }}</td>
    <td>{{ $order->phone }}</td>
    <td>{{ $order->product->title }}</td>
    <td>PHP {{ number_format($order->product->price * $order->quantity, 2) }}</td>
    <td>{{ $order->size }}</td>
    <td>{{ $order->logo }}</td>
    <td>{{ $order->quantity }}</td>
    <td>
        @if($order->product->image)
            @php
                $images = json_decode($order->product->image); // Decode the JSON string to get an array of image paths
            @endphp
            @if(is_array($images) && count($images) > 0)
                <!-- Show only the first image as thumbnail -->
                <img src="{{ asset(str_replace('\\/', '/', $images[0])) }}" alt="Product Image" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
            @else
                <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
            @endif
        @else
            <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
        @endif
    </td>
    <td>{{ $order->payment_method }}</td>
    <!-- Show reference number only for GCash -->
    <td>
        @if($order->payment_method == 'gcash' && $order->reference_number)
            <strong>Reference Number:</strong> {{ $order->reference_number }}
        @else
            N/A
        @endif
    </td>
    <td>
        @if($order->status == 'in progress')
            <span style="color:yellow">{{ $order->status }}</span>
        @elseif($order->status == 'On the Way')
            <span style="color:skyblue; background-color:transparent;">{{ $order->status }}</span>
        @elseif($order->status == 'Delivered')
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
</tbody>

            </table>
        </div>
    </div>

    @include('admin.js')
</body>

</html>
