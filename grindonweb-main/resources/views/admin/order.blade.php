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

        /* Standardized Button Styling */
/* Standardized Button Styling */
.btn {
    display: inline-block;
    padding: 10px 20px; /* Adjust button height and width */
    font-size: 14px;
    text-transform: uppercase;
    border-radius: 4px; /* Rounded corners for consistency */
    text-decoration: none;
    color: #ffffff;
    border: 2px solid transparent; /* Uniform border size */
    margin-right: 10px; /* Add spacing between buttons */
    box-sizing: border-box; /* Ensure consistent sizing */
    width: 120px; /* Make both buttons the same width */
    text-align: center; /* Center-align the button text */
}

/* Primary Button (On The Way) */
.btn-primary {
    background-color: black;
    border-color: white; /* White border for "On The Way" button */
    margin-bottom: 10px; /* Add margin between "On The Way" and "Delivered" */
}

.btn-primary:hover {
    background-color: #555555;
    border-color: white; /* Keep the white border on hover */
}

/* Success Button (Delivered) */
.btn-success {
    background-color: black;
    border-color: white; /* White border for "Delivered" button */
}

.btn-success:hover {
    background-color: #555555;
    border-color: white; /* Keep the white border on hover */
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


        /* Status Styling */
        td span {
    padding: 4px 8px;
    font-size: 14px;
    color: white; /* White text for all statuses */
    background-color: transparent; /* No background */
    border: none; /* No border */
}


td span[style="color:red"] {
    background-color: #e74c3c; /* Red background for 'in progress' */
}

td span[style="color:skyblue"] {
    background-color: #3498db; /* Skyblue background for 'On the Way' */
}

td span[style="color:green"] {
    background-color: #2ecc71; /* Green background for 'Delivered' */
}

/* Product Image Styling */
td img {
    width: 100px; /* Fixed width for consistency */
    height: 100px; /* Fixed height for consistency */
    border-radius: 8px; /* Uniform border-radius */
    object-fit: cover; /* Maintain aspect ratio and crop if necessary */
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
                        <th>Color</th>
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
            <td>{{ $order->color }}</td>
            <td>{{ $order->quantity }}</td>
            <td>
                <img src="products/{{ $order->product->image }}" alt="Product Image">
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
