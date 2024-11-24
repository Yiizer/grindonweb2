<!DOCTYPE html>
<html>

<head>
  @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->

  <section class="contact_section ">
    <div class="container px-0">
      <div class="heading_container ">
        <h2 class="">
          Contact Us
        </h2>
      </div>
    </div>
    <div class="container container-bg">
      <div class="row">
        <!-- Map Section -->
        <div class="col-lg-7 col-md-6 px-0">
          <div class="map_container">
            <div class="map-responsive">
              <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Philippines"
                      width="600" height="300" frameborder="0" 
                      style="border:0; width: 100%; height:100%" 
                      allowfullscreen></iframe>
            </div>
          </div>
        </div>

        <!-- Form Section -->
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div>
              <input type="text" name="name" placeholder="Name" required />
            </div>
            <div>
              <input type="email" name="email" placeholder="Email" required />
            </div>
            <div>
              <input type="text" name="phone" placeholder="Phone" required />
            </div>
            <div>
              <textarea name="message" class="message-box" placeholder="Message" required></textarea>
            </div>
            <div class="d-flex">
              <button type="submit">
                SEND
              </button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </section>

  <br><br><br>

  <!-- info section -->
  @include('home.footer')
</body>

</html>
