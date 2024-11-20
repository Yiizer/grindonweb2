<!DOCTYPE html>
<html>

<head>
  @include('home.css')

    <style type="text/css">

        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        table{
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }
        
        th{
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black;
        }

        td{
            border: 1px solid skyblue;
        }


        .cart_value
        {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

    </style>

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

  </div>
  <!-- end hero area -->

    <div class="div_deg">

        <table>

            <tr>
                <th>Product Title</th>

                <th>Price</th>

                <th>Image</th>
            </tr>

            <?php

            $value=0;

            ?>

            @foreach($cart as $cart)

            <tr>

                <td>{{$cart->product->title}}</td>

                <td>{{$cart->product->price}}</td>

                <td>
                    <img width="150" src="/products/{{$cart->product->image}}">
                </td>

            </tr>


            <?php

            $value = $value + $cart->product->price;

            ?>

            @endforeach

        </table>

    </div>


        <div class="cart_value">
            <h3>
                Total Pirce Of Cart Is: ₱{{$value}}
            </h3>
        </div>



  <!-- info section -->

    @include('home.footer')
</body>

</html>