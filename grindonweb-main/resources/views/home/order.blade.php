<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>

    @include('home.css')

    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 50px 20px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            text-align: center;
            padding: 15px;
        }

        th {
            background-color: #333;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        td {
            color: #555;
        }

        td img {
            border-radius: 8px;
            height: 100px;
            width: auto;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .total-price-row {
            background-color: #333;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            padding: 10px;
        }

    </style>
</head>
<body>
<div class="hero_area">
    @include('home.header')

    <div class="div_center">
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $order)
                    @php
                        $order_total = $order->product->price * $order->quantity;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->product->title }}</td>
                        <td>${{ number_format($order->product->price, 2) }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->size }}</td>
                        <td>{{ $order->color }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <img src="products/{{ $order->product->image }}" alt="{{ $order->product->title }}">
                        </td>
                        <td>${{ number_format($order_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('home.footer')
</body>
</html>
