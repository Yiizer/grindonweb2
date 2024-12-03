<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            color: #007bff;
        }

        .customer-details,
        .product-details {
            margin-bottom: 20px;
        }

        .details-title {
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .details-content p {
            margin: 5px 0;
        }

        .product-image {
            text-align: center;
            margin-top: 20px;
        }

        .product-image img {
            max-width: 300px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .total-section {
            margin-top: 30px;
            text-align: right;
        }

        .total-section h2 {
            margin: 0;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Receipt</h1>
        </div>

        <div class="customer-details">
            <div class="details-title">Customer Details</div>
            <div class="details-content">
                <p><strong>Name:</strong> {{ $data->name }}</p>
                <p><strong>Address:</strong> {{ $data->rec_address }}</p>
                <p><strong>Phone:</strong> {{ $data->phone }}</p>
            </div>
        </div>

        <div class="product-details">
            <div class="details-title">Product Details</div>
            <div class="details-content">
                <p><strong>Product Title:</strong> {{ $data->product->title }}</p>
                <p><strong>Price:</strong> PHP {{ $data->product->price }}</p>
                <p><strong>Quantity:</strong> {{ $data->quantity }}</p>
                <p><strong>Size:</strong> {{ $data->size }}</p>
                <p><strong>Color:</strong> {{ $data->color }}</p>
                <p><strong>Total:</strong> PHP {{ $data->quantity * $data->product->price }}</p>
            </div>
        </div>

        <div class="product-image">
    @if($data->product->image)
        @php
            $images = json_decode($data->product->image); // Decode the JSON string to get an array of image paths
        @endphp
        @if(is_array($images) && count($images) > 0)
            <!-- Show only the first image -->
            <img src="{{ asset(str_replace('\/', '/', $images[0])) }}" alt="{{ $data->product->title }}">
        @else
            <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image">
        @endif
    @else
        <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image">
    @endif
</div>

<div class="total-section">
    <h2>Total Amount: PHP {{ $data->quantity * $data->product->price }}</h2>
</div>

<!-- Reference Number for GCash Payment Method -->
@if($data->payment_method == 'gcash' && $data->reference_number)
    <div class="details-title">Payment Details</div>
    <div class="details-content">
        <p><strong>Reference Number:</strong> {{ $data->reference_number }}</p>
    </div>
@endif


    </div>
</body>
</html>
