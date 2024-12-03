<html lang="en">

<head>
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
            margin: 40px 0px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
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
            color: white;
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

        /* Adjusting navbar padding directly */
        #navbarSupportedContent {
            padding: 5px 0 2px 0;
            padding-bottom: 0 !important;
        }

        #navbarSupportedContent .navbar-nav .nav-link {
            padding: 5px 25px;
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
                        <th>Logo</th>
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
                            <td>PHP{{ number_format($order->product->price, 2) }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ ucfirst($order->size) }}</td>
                            <td>{{ $order->logo }}</td>
                            <td>
                                @if($order->status == 'Delivered')
                                <span style="color:green;">{{ $order->status }}</span>
                                @elseif($order->status == 'in progress')
                                <span style="color:yellow;">{{ $order->status }}</span>
                                @else
                                <span>{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if($order->product->image)
                                    @php
                                        $images = json_decode($order->product->image); // Decode the JSON string to get an array of image paths
                                    @endphp
                                    @if(is_array($images) && count($images) > 0)
                                        <!-- Only show the first image as thumbnail -->
                                        <img src="{{ asset(str_replace('\\/', '/', $images[0])) }}" alt="{{ $order->product->title }}" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
                                    @else
                                        <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
                                    @endif
                                @else
                                    <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
                                @endif
                            </td>
                            <td>PHP{{ number_format($order_total, 2) }}</td>
                        </tr>


                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('home.footer')
</body>

</html>
