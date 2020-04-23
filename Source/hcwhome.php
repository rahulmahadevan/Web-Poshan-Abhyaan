<?php
session_start();

$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");

$output="";

if(isset($_POST['submitbutton'])){
	$aadhar = $_POST['useraadhar'];
  $_SESSION['aadhar'] = $aadhar;
	$query = "SELECT * FROM `userdetails` WHERE aadhar='$aadhar';";
	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_array($result))
       {

          $name= $row["name"];
          $email= $row["email"];
          $phone= $row["phone"];
          $dob= $row["DOB"];
          $address= $row["address"];
       }
       $_SESSION['email'] = $email;
       	$output = '<form  id="form" class="validate">
  <div class="form-field">
    <label for="full-name">Name</label>
    <input class="userforminput" type="text" name="full-name" id="full-name" value='.$name.' readonly="" />
  </div>
  <div class="form-field">
    <label for="email-input">Email</label>
    <input type="email" class="userforminput" name="email-input" id="email-input" value='.$email.' readonly="" />
  </div>
  <div class="form-field">
    <label for="password-input">Phone</label>
    <input type="text" name="password-input" class="userforminput" id="password-input" readonly="" value='.$phone.' />
  </div>
  <div class="form-field">
    <label for="password-input">DOB</label>
    <input type="text" name="password-input" id="password-input" class="userforminput" readonly="" value='.$dob.'/>
  </div>
  <div class="form-field">
    <label for="password-input">Address</label>
    <input type="text" class="userforminput" name="password-input" id="password-input" readonly="" value='.$address.' />
  </div>
</form>
<style>
#form {
  margin-top : 50px;
  max-width: 500px;
  width : 400px;
  padding: 1rem;
  box-sizing: border-box;
}

.form-field {
  display: flex;
  margin: 0 0 1rem 0;
}
label, .userforminput {
  width: 70%;
  padding: 0.5rem;
  box-sizing: border-box;
  justify-content: space-between;
  font-size: 1rem;
}
label {
  text-align: right;
  width: 30%;
}
.userforminput {
  border: 2px solid #aaa;
  border-radius: 2px;
}

.button {
	visibility : visible;
}

</style>
';

	}else{

	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Poshan Abhyaan</title>
	<link rel="stylesheet" type="text/css" href="hcwhome.css">
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
      <div class="logo"><img src="logo.png" alt="logo"/></div>
      <nav>
        <ul>
          <li><a href="hcwhome.php">Home</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="nav.html">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>


<body>

  
  <h1 id="welc">Welcome, <?php echo $_SESSION['name']; ?></h1>
  <p id="id">Your ID: <?php echo $_SESSION['uuid']; ?></p>

 
<div class="centres">
 <a href="addcentre.html"><button id="addcentres">+ New Centre</button></a>
 <form action="" method="post">
 	<input type="text" name="useraadhar" id="input" placeholder="Enter Aadhar Number">
 	<input type="submit" name="submitbutton" id="searchuser" value="Search User">
 </form>
 </div>
 <div id="centredetails">
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
<div id="userdetails">
		<?php echo $output; ?>
	<button class="button"  id="btnOpenForm">Add Notes</button>
</div>
<script type="text/javascript">
	function closeForm() {
  $('.form-popup-bg').removeClass('is-visible');
}

$(document).ready(function($) {
  
  /* Contact Form Interactions */
  $('#btnOpenForm').on('click', function(event) {
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
<div class="form-popup-bg">
  <div class="form-container">
    <button id="btnCloseForm" class="close-button">X</button>
    <h1>Add Notes Here</h1>
    <form action="addnotes.php" method="get">
      <div class="form-group">
        <label for="">Centre ID</label>
        <input type="text" id="popcentreid" name="centreid">
      </div>
      <div id="divhcwname" hidden="">
        <label for="">HcW Name</label>
        <input type="text" id="pophcwname" name="hcwname" value="<?php echo $_SESSION['name'];?>">
      </div>
      <div id="divaadhar" hidden="">
        <label for="">User email</label>
        <input type="text" id="popaadhar" name="email" value="<?php echo $_SESSION['email'];?>">
      </div> 
      <div class="form-group">
         <label for="">Note</label>
        <textarea id="popupinput" cols="20" rows="5" name="notes" class="form-control" ></textarea>
      </div>

      <button>Submit</button>
    </form>
  </div>
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

         <p class="footer-company-name">A Mini Project by <br> I SRI POORVAJA (17E11A0558)<br> BHAVIRI CHANDRA LEKHA (17E11A0560)<br> MADUGULA KALYANI (17E11A0553)</p>
      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p><span>Street no. 1</span> Hyderabad, Telangana</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>9999778897</p>
        </div>

        <div>
          <i class="fa fa-envelope"></i>
          <p><a id="contact" href="mailto:support@company.com">support@poshanabhyaan.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about">
          <span>Follow us</span>
        </p>

        <div class="footer-icons">

          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-github"></i></a>

        </div>

      </div>

    </footer>

</html>