<!doctype html>
<html lang="en">
  <head><?php include 'header.php'; ?></head>

  <style>
	.contact-information {
	text-align: center;
	padding: 80px 0px 80px 5px;

	color: #fff;
	position: relative;
}

  .contact-information .contact-item {
	padding: 60px 30px;
	background-color: #204401;
	text-align: center;
}

.contact-information .contact-item i {
	color: #ffffff;
	font-size: 48px;
	margin-bottom: 40px;
}

.contact-information .contact-item h4 {
	font-size: 20px;
	font-weight: 700;
	letter-spacing: 0.25px;
	margin-bottom: 15px;
	color: white;
}

.contact-information .contact-item p {
	margin-bottom: 20px;
	color: white;
}

.contact-information .contact-item a {
	font-weight: 600;
	color: #d5ff77;
	font-size: 15px;
}
  </style>
  <body>

  	<?php include 'top.php'; ?>

	  <div class="page-headinggg header-text d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Contact Us</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="contact-information">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="contact-item">
              <i class="fa fa-phone"></i>
              <h4>Phone</h4>
              <p>+63 1 8 234 5678</p>
              <a href="#">Call Now!</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-item">
              <i class="fa fa-envelope"></i>
              <h4>Email</h4>
              <p>harvestingsucces@gmail.com</p>
              <a href="#">Email Now!</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-item">
              <i class="fa fa-map-marker"></i>
              <h4>Location</h4>
              <p>Mabini, Pangasinan City, Philippines</p>
              <a href="#">Visit Now!</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="map">
<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122716.53494236294!2d119.9432071047811!3d16.019151365386673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3393e90001d11061%3A0x274624e3d598ad87!2sSan%20Pedro%20Mabini%20Pangasinan!5e0!3m2!1sen!2sph!4v1712132202665!5m2!1sen!2sph" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  	<?php include 'footer.php'; ?>
  </body>
</html>

