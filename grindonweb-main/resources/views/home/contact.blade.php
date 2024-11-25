<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <style>
    /* Default style for all input fields and the textarea */
    .message-box,
    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid gray; /* Subtle thin gray border */
      border-radius: 5px; /* Rounded corners */
      outline: none; /* Remove default outline */
      transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    }

    /* Style for the message box specifically */
    .message-box {
      resize: vertical; /* Allows resizing */
      height: auto; /* Flexible height */
    }

    /* Focus effect for input fields and textarea */
    .message-box:focus,
    input[type="text"]:focus,
    input[type="email"]:focus {
      border: 2px solid black; /* Bold black border on focus */
      box-shadow: 0 0 5px black; /* Optional: Add a shadow for better effect */
    }

    /* Default style for the send button */
    form .custom-button {
      background-color: black !important; /* Default black background */
      color: white !important; /* White text color */
      padding: 10px 20px;
      border: 2px solid white; /* Add a border for a clean look */
      border-radius: 5px; /* Rounded corners */
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    /* Hover effect for the send button */
    form .custom-button:hover {
      background-color: white !important; /* Change background to white */
      color: black !important; /* Change text to black */
      border-color: black; /* Change border color to black */
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->

  <section class="contact_section">
    <div class="container px-0">
      <div class="heading_container">
        <h2 style="padding-top: 20px;">
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
              <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=14.8136,121.0453"
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
            <textarea name="message" class="message-box" placeholder="Message" rows="6" required></textarea>
          </div>
          <div class="d-flex">
            <button type="submit" class="custom-button">
              SEND
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <br><br><br>

  <!-- info section -->
  @include('home.footer')
</body>

</html>
