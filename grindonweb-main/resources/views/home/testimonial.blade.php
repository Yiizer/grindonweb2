<!DOCTYPE html>
<html>

<head>
  @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

  </div>
  <!-- end hero area -->





    <!-- client section -->
  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Testimonial
        </h2>
      </div>
    </div>
    <div class="container px-0">
  <div id="customCarousel2" class="carousel carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="box">
          <div class="client_info">
            <div class="client_name">
              <h5>제트re#jett</h5>
            </div>
            <i class="fa fa-quote-left" aria-hidden="true"></i>
          </div>
          <p>
            I’ve been using your jerseys for all my online competitions, and they’ve never let me down. The fit is true to size, and the vibrant designs are a hit with my teammates. I’m definitely going to order more for my upcoming events!
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <div class="box">
          <div class="client_info">
            <div class="client_name">
              <h5>Xevo</h5>
            </div>
            <i class="fa fa-quote-left" aria-hidden="true"></i>
          </div>
          <p>
            As a competitive gamer, comfort and performance are key – and your jerseys deliver on both! The fit is perfect, and I can play for hours without any discomfort. The design is sleek and really represents my team. Love it!
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <div class="box">
          <div class="client_info">
            <div class="client_name">
              <h5>Zavs</h5>
            </div>
            <i class="fa fa-quote-left" aria-hidden="true"></i>
          </div>
          <p>
            I’ve worn several esports jerseys, but nothing compares to the quality and attention to detail in your designs. The stitching is solid, and the fabric feels premium. Plus, the custom logo for my team turned out perfect!
          </p>
        </div>
      </div>
      <!-- Add MarkPie testimonial -->
      <div class="carousel-item">
        <div class="box">
          <div class="client_info">
            <div class="client_name">
              <h5>MarkPie</h5>
            </div>
            <i class="fa fa-quote-left" aria-hidden="true"></i>
          </div>
          <p>
            I’m always in the market for a high-quality jersey for gaming, and I finally found the perfect one. Your jerseys are not just stylish but functional, with moisture-wicking technology that keeps me dry and comfortable while gaming.
          </p>
        </div>
      </div>
      <!-- Add Brexotic testimonial -->
      <div class="carousel-item">
        <div class="box">
          <div class="client_info">
            <div class="client_name">
              <h5>Brexotic</h5>
            </div>
            <i class="fa fa-quote-left" aria-hidden="true"></i>
          </div>
          <p>
            I was looking for a jersey that not only looked cool but also felt great during long gaming sessions. Your jerseys are breathable and lightweight, and the material keeps me cool even during intense tournaments. Highly recommend for any esports athlete!
          </p>
        </div>
      </div>
    </div>
    <div class="carousel_btn-box">
      <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev" style="background-color: black;">
        <i class="fa fa-angle-left" aria-hidden="true" style="color: white;"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next" style="background-color: black;">
        <i class="fa fa-angle-right" aria-hidden="true" style="color: white;"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>

  </section>
  <!-- end client section -->





   

  <!-- info section -->

    @include('home.footer')
</body>

</html>