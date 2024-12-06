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

        /* General Button Styles (inherits from .btn) */
        .btn {
            padding: 14px 35px;
            font-size: 18px;
            color: #fff; /* White text initially */
            background-color: #000; /* Black background */
            border: 2px solid #000; /* Match border with initial background */
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Adjust this value as needed */
        }

        /* Hover Effect for Button */
        .btn:hover {
            background-color: #fff; /* White background on hover */
            color: #000; /* Black text on hover */
            border: 2px solid #000;
        }

        /* Specific Style for 'Place Order' Button */
        .btn-place-order {
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2); /* Extra shadow for 'Place Order' */
        }

        /* Hover Effect for 'Place Order' Button */
        .btn-place-order:hover {
            background-color: #fff; /* Matches the general hover effect */
            color: #000; 
        }

        .btn-danger {
            background-color: red;
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
            color: black;
        }

        /* Gcash Modal Style */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

/* Laptop screens */
@media screen and (min-width: 769px) and (max-width: 1366px) {
    .div_deg {
        margin: 20px 10px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .order_deg {
        width: 100%;
        margin-bottom: 20px;
    }

    .div_center {
        width: 100%;
    }

    .div_center table {
        width: 100%;
        font-size: 12px;
        table-layout: fixed;
    }

    .div_center table th,
    .div_center table td {
        padding: 8px 4px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .div_center table th:first-child,
    .div_center table td:first-child {
        width: 5%;
    }

    .div_center table th:nth-child(2),
    .div_center table td:nth-child(2) {
        width: 15%;
    }

    .div_center table th:nth-child(3),
    .div_center table td:nth-child(3),
    .div_center table th:nth-child(4),
    .div_center table td:nth-child(4),
    .div_center table th:nth-child(5),
    .div_center table td:nth-child(5),
    .div_center table th:nth-child(6),
    .div_center table td:nth-child(6) {
        width: 10%;
    }

    .div_center table th:nth-child(7),
    .div_center table td:nth-child(7) {
        width: 15%;
    }

    .div_center table th:last-child,
    .div_center table td:last-child {
        width: 10%;
    }

    .div_center table img {
        width: 60px;
        height: auto;
    }

    .btn {
        padding: 6px 10px;
        font-size: 12px;
    }
}

@media screen and (min-width: 1024px) and (max-width: 1366px) {
    .div_deg {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .order_deg {
        width: 35%;
        margin-right: 15px;
    }

    .div_center {
        width: 63%;
    }

    .div_center table {
        width: 100%;
        font-size: 13px;
        table-layout: fixed;
    }

    .div_center table th,
    .div_center table td {
        padding: 6px 3px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .div_center table th:first-child,
    .div_center table td:first-child {
        width: 5%;
    }

    .div_center table th:nth-child(2),
    .div_center table td:nth-child(2) {
        width: 18%;
    }

    .div_center table th:nth-child(3),
    .div_center table td:nth-child(3),
    .div_center table th:nth-child(4),
    .div_center table td:nth-child(4),
    .div_center table th:nth-child(5),
    .div_center table td:nth-child(5),
    .div_center table th:nth-child(6),
    .div_center table td:nth-child(6) {
        width: 10%;
    }

    .div_center table th:nth-child(7),
    .div_center table td:nth-child(7) {
        width: 12%;
    }

    .div_center table th:last-child,
    .div_center table td:last-child {
        width: 10%;
    }

    .thumbnail-image {
        width: 50px;
        height: auto;
    }

    .btn {
        font-size: 11px;
        padding: 5px 8px;
    }

    input[type="text"], textarea {
        font-size: 13px;
    }

    .div_gap {
        margin-bottom: 12px;
    }
}



/* Tablet and mobile styles  */
@media screen and (max-width: 1024px) and (min-width: 769px) {
    .div_deg {
        flex-direction: column;
        margin: 20px 10px;
    }

    .order_deg {
        width: 100%;
        margin-right: 0;
        margin-bottom: 20px;
    }

    .div_center {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .div_center table {
        width: 100%;
        min-width: 300px;
        font-size: 12px;
    }

    .div_center table th,
    .div_center table td {
        white-space: nowrap;
        padding: 6px 4px;
    }

    .div_center table th:first-child,
    .div_center table td:first-child {
        width: 30px;
    }

    .div_center table th:nth-child(2),
    .div_center table td:nth-child(2) {
        max-width: 80px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .div_center table img {
        width: 40px;
        height: auto;
    }

    .div_center:last-of-type {
        display: flex;
        justify-content: center;
        overflow-x: hidden;
    }

    .div_center:last-of-type table {
        width: auto;
        min-width: auto;
    }

    .btn {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-danger {
        padding: 4px 8px;
        font-size: 11px;
    }

    .modal-content {
        width: 90%;
        max-width: 400px;
    }
}



    @media screen and (max-width: 768px) {
    .div_deg {
        flex-direction: column;
        margin: 20px 10px;
    }

    .order_deg {
        width: 100%;
        margin-right: 0;
        margin-bottom: 20px;
    }

    .div_center {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }

    .div_center table {
        width: 100%;
        min-width: 300px; /* Reduced from 800px */
        font-size: 12px;
    }

    .div_center table th,
    .div_center table td {
        white-space: nowrap;
        padding: 6px 4px;
    }

    /* Reduce column widths */
    .div_center table th:first-child,
    .div_center table td:first-child {
        width: 30px; /* Checkbox column */
    }

    .div_center table th:nth-child(2),
    .div_center table td:nth-child(2) {
        max-width: 80px; /* Product title */
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .div_center table img {
        width: 40px;
        height: auto;
    }

    /* Center the total value table */
    .div_center:last-of-type {
        display: flex;
        justify-content: center;
        overflow-x: hidden; /* Prevent scrolling for total table */
    }

    .div_center:last-of-type table {
        width: auto;
        min-width: auto;
    }

    .btn {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-danger {
        padding: 4px 8px;
        font-size: 11px;
    }

    .modal-content {
        width: 90%;
        max-width: 400px;
    }
}

@media screen and (max-width: 480px) {
    .div_deg {
        margin: 10px 5px;
    }

    .div_center table {
        min-width: 280px; /* Even smaller for very small screens */
    }

    .div_center table th,
    .div_center table td {
        padding: 4px 2px;
        font-size: 11px;
    }

    .div_center table img {
        width: 30px;
    }

    /* Hide less important columns on very small screens */
    .div_center table th:nth-child(4),
    .div_center table td:nth-child(4),
    .div_center table th:nth-child(5),
    .div_center table td:nth-child(5) {
        display: none; /* Hide Size and Logo columns */
    }

    .btn {
        padding: 4px 8px;
        font-size: 11px;
    }
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

        <!-- Swapped: Payment Method Section Comes First -->
        <div class="div_gap">
            <label>Select Payment Method:</label>
            <div>
                <input type="radio" id="cash_on_delivery" name="payment_method" value="cash_on_delivery">
                <label for="cash_on_delivery">Cash on Delivery</label>
            </div>
            <div>
                <input type="radio" id="gcash" name="payment_method" value="gcash">
                <label for="gcash">GCash</label>
            </div>
        </div>

        <!-- Swapped: Place Order Button Comes After Payment Method -->
        <div class="div_gap">
            <input class="btn btn-place-order" type="button" value="Place Order" onclick="confirm_order()">
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
                            <th>Logo</th>
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
                            <td>PHP {{ number_format($cart->product->price, 2) }}</td>
                            <td>{{ $cart->size }}</td>
                            <td>{{ $cart->logo }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>
                                @if($cart->product->image)
                                    @php
                                        $images = json_decode($cart->product->image); // Decode the JSON string to get an array of image paths
                                    @endphp
                                    @if(is_array($images) && count($images) > 0)
                                        <!-- Only show the first image as thumbnail -->
                                        <img src="{{ asset(str_replace('\\/', '/', $images[0])) }}" alt="{{ $cart->product->title }}" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
                                    @else
                                        <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
                                    @endif
                                @else
                                    <img src="{{ asset('images/products/default-image.jpg') }}" alt="No Image" class="thumbnail-image" style="width: 100px; height: auto; cursor: pointer;">
                                @endif
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
                            <td id="total-price">PHP {{ number_format($total, 2) }}</td>
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

<!-- Gcash Payment Modal -->
<div id="gcash-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>
        <h3>Gcash Payment Details</h3>
        <p>Please transfer the amount to the following Gcash details:</p>
        <p><strong>Account Number:</strong> 0976 405 6887</p>
        <p><strong>Account Name:</strong> Grind On</p>
        <p><strong>Amount:</strong> PHP <span id="gcash-amount"></span></p>
        <label for="reference_number">Reference Number:</label>
        <input type="text" id="reference_number" name="reference_number" placeholder="Enter reference number">
        <div class="div_gap">
            <input class="btn" type="button" value="Confirm Payment" onclick="submitOrder()">
        </div>
    </div>
</div>

<script type="text/javascript">
   function confirm_order() {
    const paymentMethodInput = document.querySelector('input[name="payment_method"]:checked');

    if (!paymentMethodInput) {
        alert("Please select a payment method.");
        return;
    }

    const paymentMethod = paymentMethodInput.value;

    if (paymentMethod === "gcash") {
        // Update the total amount calculation
        updateTotalForGcash();  // Ensure the total is calculated for Gcash
        document.getElementById('gcash-modal').style.display = "flex";
        return;
    }

    if (confirm("Are you sure you want to place your order?")) {
        document.getElementById("orderForm").submit();
    }
}

function submitOrder() {
    const referenceNumber = document.getElementById('reference_number').value.trim();

    if (!referenceNumber) {
        alert("Please enter the reference number.");
        return;
    }

    const referenceInput = document.createElement("input");
    referenceInput.type = "hidden";
    referenceInput.name = "reference_number";
    referenceInput.value = referenceNumber;
    document.getElementById("orderForm").appendChild(referenceInput);

    closeModal();
    document.getElementById("orderForm").submit();
}

function closeModal() {
    document.getElementById('gcash-modal').style.display = "none";
}

function updateTotalForGcash() {
    let total = 0;
    // Get all checked checkboxes and calculate the total dynamically
    const checkboxes = document.querySelectorAll('.item-checkbox');
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const price = parseFloat(checkbox.getAttribute('data-price'));
            const quantity = parseInt(checkbox.getAttribute('data-quantity'));
            total += price * quantity;
        }
    });

    // Update the total value in the DOM and also set it for the Gcash modal
    document.getElementById('total-price').textContent = 'PHP ' + total.toFixed(2);
    document.getElementById('gcash-amount').textContent = total.toFixed(2);
}

const checkboxes = document.querySelectorAll('.item-checkbox');
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateTotalForGcash);  // Ensure total is updated when a checkbox is clicked
});
</script>


    @include('home.footer')
</body>

</html>
