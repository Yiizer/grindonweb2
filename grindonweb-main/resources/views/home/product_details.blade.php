<!DOCTYPE html>
<html>

<head>
  @include('home.css')

  <style type="text/css">
    .div_center {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px;
    }

    .detail-box {
      padding: 15px;
    }

    .add-to-cart-btn {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- Product details start -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Product Details
        </h2>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="box">

            <div class="div_center">
              <img width="400" src="/products/{{$data->image}}" alt="">
            </div>

            <div class="detail-box">
              <h6>{{ $data->title }}</h6>
              <h6>Price:
                <span>
                  {{ $data->price }}
                </span>
              </h6>
            </div>

            <div class="detail-box">
              <h6>Category: {{ $data->category }}</h6>
              <h6>Available Quantity:
                <span>{{ $data->quantity }}</span>
              </h6>
            </div>

            <div class="detail-box">
              <p>{{ $data->description }}</p>
            </div>

            <!-- Add to Cart Form -->
            <form action="{{ route('add_cart', $data->id) }}" method="POST">
              @csrf

              <!-- Size selection -->
              <div class="detail-box">
                <label for="size">Size:</label>
                <select name="size" id="size" required>
                  <option value="Small">Small</option>
                  <option value="Medium">Medium</option>
                  <option value="Large">Large</option>
                </select>
              </div>

              <!-- Color selection -->
              <div class="detail-box">
                <label for="color">Color:</label>
                <select name="color" id="color" required>
                  <option value="Black">Black</option>
                  <option value="White">White</option>
                </select>
              </div>

              <!-- Quantity selection -->
              <div class="detail-box">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $data->quantity }}" required>
              </div>

              <!-- Submit button -->
              <div class="add-to-cart-btn">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Product details end -->

  @include('home.footer')
</body>

</html>
