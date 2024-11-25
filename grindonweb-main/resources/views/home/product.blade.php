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
              <h6>Price:
                <span>
                  PHP {{ $products->price }}
                </span>
              </h6>
            </div>
          </div>
        </a>
        <!-- "Add to Cart" button remains functional -->
        
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
    height: 350px; /* Ensures uniform height for all cards */
    display: flex;
    flex-direction: column; /* Align content vertically */
    justify-content: space-between; /* Spread items across the height */
  }

  .box:hover {
    transform: translateY(-10px);
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
  }

  .img-box {
    flex: 1; /* Allow the image container to expand */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden; /* Hide overflowing parts of the image */
    margin-bottom: 10px; /* Add spacing below the image */
  }

  .img-box img {
    width: 100%; /* Ensures the image fills the width */
    height: 100%; /* Ensures the image fills the height */
    object-fit: cover; /* Crops the image while maintaining its aspect ratio */
    border-radius: 5px;
    transition: transform 0.3s ease;
  }

  .box:hover .img-box img {
    transform: scale(1.05); /* Slight zoom on hover */
  }

  .detail-box {
    text-align: center; /* Center-align text inside the detail box */
    margin-top: 10px; /* Add some spacing above the text */
  }

  .detail-box h6 {
    margin: 5px 0; /* Add minimal spacing around text elements */
    font-size: 16px; /* Adjust font size for better readability */
    line-height: 1.5; /* Ensure proper spacing between lines */
  }

  .detail-box h6 span {
    color: #e63946; /* Highlight the price in red or any desired color */
    font-weight: bold; /* Make the price bold for emphasis */
  }
</style>


