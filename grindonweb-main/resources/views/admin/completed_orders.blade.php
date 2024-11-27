<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .page-content {
            padding: 20px;
            background-color: #ffffff;
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
            background-color: #ffffff;
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

        .btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            text-transform: uppercase;
            border-radius: 4px;
            text-decoration: none;
            color: #ffffff;
            margin-right: 5px;
            transition: background-color 0.3s ease;
        }

        /* Secondary Button (Print PDF) */
.btn-secondary {
    background-color: black; /* Light grey background for "Print PDF" */
    border-color: white; /* White border for "Print PDF" */
}

.btn-secondary:hover {
    background-color: #555555;
    border-color: white; /* Keep the white border on hover */
}

        td span {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
        }

        td span[style="color:green"] {
            background-color: #d6d6d6;
            color: #333333;
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

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <h3>Completed Orders</h3>
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
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Payment Method</th>
                        <th>Status</th>
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
                            <td>${{ number_format($order->product->price * $order->quantity, 2) }}</td>
                            <td>{{ $order->size }}</td>
                            <td>{{ $order->color }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>
                                <img src="products/{{ $order->product->image }}" alt="Product Image">
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td><span style="color:green">{{ $order->status }}</span></td>
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
