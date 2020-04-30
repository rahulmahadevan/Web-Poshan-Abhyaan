<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script>	
		jQuery(document).ready(function($) {
			tab = $('.tabs h3 a');

			tab.on('click', function(event) {
				event.preventDefault();
				tab.removeClass('active');
				$(this).addClass('active');

				tab_content = $(this).attr('href');
				$('div[id$="tab-content"]').removeClass('active');
				$(tab_content).addClass('active');
			});
		});
	</script>
</head>
<header>
    <div class="container">
      <div class="logo"><img src="logo.png" alt="logo"/></div>

      <nav>
        <ul>
          <li><a href="userhome.php">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
<body>
	<!--FORM STARTS HERE-->
	<?php
		session_start();
		$name = $_SESSION['name'];
		$password = $_SESSION['password'];
		$email = $_SESSION['email'];
	?>
	<div class="form-wrap">
			<div class="tabs">
				<h3 class="signup-tab"><a class="active" href="#signup-tab-content">Update Here</a></h3>
				
			</div><!--.tabs-->

			<div class="tabs-content">
				<div id="signup-tab-content" class="active">
					<form class="signup-form" action="userdetails.php" method="get">
						<input type="text" class="input" id="user_email" name="aadhar" autocomplete="off" placeholder="Aadhar Number">
						<input type="text" class="input" id="uuid" name="dob" autocomplete="off" placeholder="DOB - DD/MM/YYYY">
						<input type="text" class="input" id="user_pass" name="address" autocomplete="off" placeholder="Address">
						<input type="text" class="input" id="user_pass" name="phno" autocomplete="off" placeholder="Phone Number">
						<input type="submit" class="button" value="Submit">
					</form><!--.login-form-->
					<div class="help-text">
						<p>By submitting, you agree to our</p>
						<p><a href="#">Terms of service</a></p>
					</div><!--.help-text-->
				</div><!--.signup-tab-content-->

				
			</div><!--.tabs-content-->
		</div><!--.form-wrap-->
	<!-- FORM CODE ENDS HERE-->

</body>

<link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
 <footer class="footer-distributed">

      <div class="footer-left">

        <IMG SRC="" ALT="" WIDTH=150 HEIGHT=100>

       <p class="footer-links">
          <a href="#">Home</a> |
          <a href="#">About</a> |
          <a href="#">Centres</a> |
          <a href="#">FAQ</a> |
          <a href="#">Contact</a>
        </p>

          <p class="footer-company-name">A Project for SIH by <br> Rahul Mahadevan</p>
      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>Street no. 1</span> Hyderabad, Telangana</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>7702XXXXXX</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a id="contact" href="mailto:rahulmahadevanrs@gmail.com">rahulmahadevanrs@gmail.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span>Follow us</span>
        </p>

        <div class="footer-icons">

          <a href="https://www.facebook.com/rahulmahadevanrs"><i class="fa fa-facebook"></i></a>
          <a href="https://twitter.com/rahul_mahadevan"><i class="fa fa-twitter"></i></a>
          <a href="https://www.linkedin.com/in/rahulmahadevan/"><i class="fa fa-linkedin"></i></a>
          <a href="github.com/rahulmahadevan"><i class="fa fa-github"></i></a>

        </div>

      </div>

    </footer>
</html>