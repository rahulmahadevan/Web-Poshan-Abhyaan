<?php

$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");

$centreid = $_GET['centreid'];
$email = $_GET['email'];
$date = $_GET['date'];

$query = "INSERT INTO `appointments` VALUES ('$date','$email','$centreid');";
$result = mysqli_query($conn,$query);

if($result){
	echo '<script>alert("Appointment Confirmed");
  window.location.href = "userhome.php";
  </script>'; //success
}else {
	echo '<script>alert("Technical issue, please try again later");;
  window.location.href = "userhome.php";
  </script>'; //failed;
 }

?>