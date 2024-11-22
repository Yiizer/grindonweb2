<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Latest Products
      </h2>
    </div>
    <div class="row">
      @foreach($product as $products)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <!-- Entire product card is now clickable -->
        <a href="{{ url('product_details', $products->id) }}" class="product-link" style="text-decoration: none; color: inherit;">
          <div class="box" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="img-box">
              <img src="products/{{ $products->image }}" alt="Product Image" style="width: 100%; border-radius: 5px;">
            </div>
            <div class="detail-box" style="padding: 15px;">
              <h6>{{ $products->title }}</h6>
              <h6>Price
                <span>
                  {{ $products->price }}
                </span>
              </h6>
            </div>
          </div>
        </a>
        <!-- "Add to Cart" button remains functional -->
        <div style="padding: 15px; text-align: center;">
          <a class="btn btn-primary" href="{{ url('add_cart', $products->id) }}">Add to Cart</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<style>
  .box {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }

  .box:hover {
    transform: translateY(-10px);
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
  }

  .img-box img {
    transition: transform 0.3s ease;
  }

  .box:hover .img-box img {
    transform: scale(1.05);
  }
</style>
