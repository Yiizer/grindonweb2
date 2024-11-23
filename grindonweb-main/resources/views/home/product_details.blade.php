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
              <img width="400" src="/products/{{$data->image}}" alt="Product Image">
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
            <form action="{{ route('add.cart', $data->id) }}" method="POST">
              @csrf

              <!-- Size selection -->
              <div class="detail-box">
                <label for="size">Size:</label>
                <select name="size" id="size" required>
                  <option value="Small" {{ old('size') == 'Small' ? 'selected' : '' }}>Small</option>
                  <option value="Medium" {{ old('size') == 'Medium' ? 'selected' : '' }}>Medium</option>
                  <option value="Large" {{ old('size') == 'Large' ? 'selected' : '' }}>Large</option>
                </select>
              </div>

              <!-- Color selection -->
              <div class="detail-box">
                <label for="color">Color:</label>
                <select name="color" id="color" required>
                  <option value="Black" {{ old('color') == 'Black' ? 'selected' : '' }}>Black</option>
                  <option value="White" {{ old('color') == 'White' ? 'selected' : '' }}>White</option>
                </select>
              </div>

              <!-- Quantity selection -->
              <div class="detail-box">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $data->quantity }}" required>
              </div>

              <!-- Submit button -->
              <div class="add-to-cart-btn">
                @if ($data->quantity == 0)
                    <button type="button" class="btn btn-danger" disabled>Out of Stock</button>
                @else
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                @endif
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
