<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .hero_area {
            background-color: #fff;
        }

        .div_deg {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin: 40px;
        }

        .order_deg {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            border-radius: 5px;
            margin-right: 50px;
        }

        .div_gap {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: inline-block;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        .cart_value {
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .btn {
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-top: 20px;
        }

        table {
            width: 80%;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            border-radius: 5px;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        td img {
            height: 100px;
            width: auto;
            border-radius: 5px;
        }

        tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        tr:hover {
            background-color: #f0f0f0;
        }

        .total-price-row {
            background-color: #333;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            padding: 10px;
        }

        .no-items-message {
            text-align: center;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <div class="div_deg">
        @if(count($cart) > 0) <!-- Only show order form if cart is not empty -->
        <!-- Order Form -->
        <div class="order_deg">
            <h3 style="text-align:center; color: #333;">Place Your Order</h3>
            <form action="{{ url('confirm_order') }}" method="POST" id="orderForm">
                @csrf

                <div class="div_gap">
                    <label>Receiver Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}">
                </div>

                <div class="div_gap">
                    <label>Receiver Address</label>
                    <textarea name="address">{{ Auth::user()->address }}</textarea>
                </div>

                <div class="div_gap">
                    <label>Receiver Phone</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                </div>

                <div class="div_gap">
                    <input class="btn" type="button" value="Place Order" onclick="confirmOrder()">
                </div>
            </form>
        </div>
        @endif

        <!-- Cart Table -->
        @if(count($cart) > 0)
            <div class="div_center">
                <table>
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <?php $total = 0; ?>
                        @foreach ($cart as $cart)
                            <tr>
                                <td>
                                    <input type="checkbox" class="item-checkbox" data-price="{{ $cart->product->price }}" data-quantity="{{ $cart->quantity }}" checked onclick="updateTotal()">
                                </td>
                                <td>{{ $cart->product->title }}</td>
                                <td>${{ number_format($cart->product->price, 2) }}</td>
                                <td>{{ $cart->size }}</td>
                                <td>{{ $cart->color }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>
                                    <img src="/products/{{ $cart->product->image }}" alt="{{ $cart->product->title }}">
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ url('delete_cart', $cart->id) }}">Remove</a>
                                </td>
                            </tr>
                            <?php $total += $cart->product->price * $cart->quantity; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cart Total Table moved below -->
            <div class="div_center">
                <table>
                    <thead>
                        <tr>
                            <th>Total Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="total-price">${{ number_format($total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="no-items-message">
                <p>Your cart is empty. Add items to your cart to proceed with the order.</p>
            </div>
        @endif
    </div>

    <script type="text/javascript">
        function confirmOrder() {
            // Check if at least one checkbox is selected
            const checkboxes = document.querySelectorAll('.item-checkbox');
            let isChecked = false;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    isChecked = true;
                }
            });

            if (!isChecked) {
                alert("You must select at least one product to place the order.");
                return;
            }

            // Proceed with form submission if a product is selected
            if (confirm("Are you sure you want to place your order?")) {
                document.getElementById("orderForm").submit();
            }
        }

        function updateTotal() {
            let total = 0;
            // Get all checked checkboxes and update the total
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const price = parseFloat(checkbox.getAttribute('data-price'));
                    const quantity = parseInt(checkbox.getAttribute('data-quantity'));
                    total += price * quantity;
                }
            });
            // Update the total value in the DOM
            document.getElementById('total-price').textContent = '$' + total.toFixed(2);
        }
    </script>

    @include('home.footer')
</body>

</html>
