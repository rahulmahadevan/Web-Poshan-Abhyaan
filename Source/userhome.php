<?php

session_start();

$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Poshan Abhyaan</title>
	<link rel="stylesheet" type="text/css" href="userhome.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>	
		$(document).ready(function($) {
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
      <div class="logo"><img src="logoOld.png" alt="logo"/></div>
      <nav>
        <ul>
          <li><a href="userhome.php">Home</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="nav.html">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>


<body>
  <h1 id="welc">Welcome, <?php echo $_SESSION['name']; ?></h1>

  <p id="upcoming"><?php 
  $email = $_SESSION['email'];
  date_default_timezone_set("Asia/Calcutta");
  $datenow = date('d/m/Y');

  $query = "SELECT * FROM `appointments` WHERE email='$email';";
  $result = mysqli_query($conn,$query);

  if(mysqli_num_rows($result)> 0){
  	while($row = mysqli_fetch_assoc($result)){
  		$date = $row['date'];
  		$centreid = $row['centreid'];
  	}
  	if($date > $datenow){
  		echo "You have an appointment scheduled on ".$date." at Centre ID ".$centreid;
  	}else {
  		echo " You have no upcoming appointments";
  	}
  }else {
  	echo " You have no upcoming appointments";
  }

  ?></p>
 <script type="text/javascript">
 	function closeForm() {
  $('.form-popup-bg').removeClass('is-visible');
}

$(document).ready(function($) {
  
  /* Contact Form Interactions */
  $('#schedule').on('click', function(event) {
    event.preventDefault();

    $('.form-popup-bg').addClass('is-visible');
  });
  
    //close popup when clicking x or off popup
  $('.form-popup-bg').on('click', function(event) {
    if ($(event.target).is('.form-popup-bg') || $(event.target).is('#btnCloseForm')) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  
  
  
  });
 </script>
  <div id="notes">
  	<a href="#"><button id='schedule'>Schedule Appointment</button></a>
  	<div class="form-popup-bg">
  <div class="form-container">
    <button id="btnCloseForm" class="close-button">X</button>
    <h1>Schedule Appointment</h1>
    <form action="scheduleappointment.php" method="get">
      <div class="form-group">
      	<label>Centre ID:</label>
        <input type="text" name="centreid" class="form-control" />
      </div><br>
      <div class="form-group">
      	<label>Date of Appointment (DD/MM/YYYY):</label>
        <input type="text" name="date" class="form-control" />
      </div>
      <div class="form-group">
        <input type="text" name="email" class="form-control" value="<?php
         echo $_SESSION['email']; 
         ?>" hidden/>
      </div>
      <br><br>
      <button>Submit</button>
    </form>
  </div>
</div>
  	<a href="userhome.php"><button id="refresh">Refresh</button></a>
  	<br><br>
  	<?php
  	  $email = $_SESSION['email'];
  	  $sql = "SELECT * FROM `notes` WHERE email='$email';";
  	  $result = mysqli_query($conn,$sql);
  	  if(mysqli_num_rows($result)){
  	  	echo '<h3 id="h3">History of Appointments</h3>';
  	  	while($row = mysqli_fetch_assoc($result)){
  	  		echo "<p id='pdate'>".$row['date']."</p>";
  	  		echo "<p id='pcentreid'>Centre ID:".$row['centreid']."</p>";
  	  		echo "<p id='phcw'>Healthcare Worker: ".$row['hcwname']."</p>";
  	  		echo "<p id='pnote'>Note: ".$row['note']."</p>";
  	  		echo "<br><br>";
  	  	}
  	  	echo '<style>
  	  	#pdate {
  	  	float:left;
  	  	font-family : georgia;
  	  	margin-left: 10px;
  	  	}

  	  	#pcentreid {
  	  	float : right;
  	  	margin-right : 10px;  	  	
  	  	font-family : georgia;
  		}

  		#phcw {
  			margin-top:60px;
  			margin-left: 140px;
	  	  	font-family : georgia;

  		}

  		#pnote {
  		margin-top: 20px;
  		margin-left : 20px;
  		font-family : georgia;
  		margin-right: 20px; 
  	}

  	  	</style>';

  	  }else{
  	  	echo "NO";
  	  }

  	?>
  </div>


  <div id="centres">
  <?php 
 	 $sql = "SELECT * FROM `centre` ORDER BY name";
 	 $result = mysqli_query($conn,$sql);
 	 $flag = 1;
 	 if(mysqli_num_rows($result) >0){
 	 	while($row = mysqli_fetch_assoc($result)){
 	 		if($flag==1){
 	 			echo "<table><tr><th>Centre Name</th><th>Centre ID</th><th>Address</th></tr>";
 	 			$flag = 0;
 	 		}
 	 		echo "<tr>";
 	 		echo "<td>";
 	 		echo $row['name'];
 	 		echo "</td>";
 	 		echo "<td>";
 	 		echo $row['centreid'];
 	 		echo "</td>";
 	 		echo "<td>";
 	 		echo $row['location'];
 	 		echo "</td>";
 	 		echo "</tr>";
 	 	}
 	 		
 	 	echo "</table>";
 	 }else{
 	 	echo "<h3 id='nomore'>There are no more Centres</h3>";
 	 }
 	 echo "<style>
 	table {
  		border-collapse: collapse;
  		width : 583px;
	}
 	th {
 		background: #ccc;
	}

	th, td {
  		border: 1px solid #ccc;
  		padding: 8px;
	}

	tr:nth-child(even) {
  		background: #efefef;
	}

	tr:hover {
  		background: #d1d1d1;
	}
	</style>";
 	 ?>
 </div>

</body>

<!-- Site footer -->
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