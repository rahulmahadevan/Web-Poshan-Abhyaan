<?php

$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");

$name = $_GET['hcwname'];
$centreid = $_GET['centreid'];
$note = $_GET['notes'];
date_default_timezone_set('Asia/Calcutta');
$date = date('d/m/Y');
$email = $_GET['email'];

$query = "INSERT INTO `notes` VALUES ('$date','$centreid','$name','$note','$email');";

$result = mysqli_query($conn,$query);

if($result){
	echo '<script>alert("Done. Please Continue with next user");
  window.location.href = "hcwhome.php";
  </script>'; //success
}else {
	echo '<script>alert("Technical issue, please try again later");;
  window.location.href = "hcwhome.php";
  </script>'; //failed;
}