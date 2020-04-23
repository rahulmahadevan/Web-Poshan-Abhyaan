<?php
session_start();

$email = $_GET['email'];
$password = $_GET['password'];
$name = $_GET['name'];
$id = $_GET['uuid'];

$_SESSION['name'] = $name;
$_SESSION['uuid'] = $id;

$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");

//check if user already exists
//if not insert into table (acc to type) values

$query = mysqli_query($conn,"SELECT * FROM `healthcare` WHERE email='$email';");
$row = mysqli_fetch_array($query);
$data = $row[0];
if(!$data){
	$Sql = "INSERT INTO `healthcare` values ('$name','$id','$email','$password');";
		
		if (mysqli_query($conn, $Sql))
              {
               		header("Location: hcwhome.php"); //signup successful  //GO TO HEALTHCARE WORKER HOME PAGE
               }
           else{
               echo '<script>alert("Please Try again after sometime!");
  window.location.href = "healthcarelogin.html";
  </script>';  //signup failed 
 			}  
}else{
	echo '<script>alert("User already exists, Please Login");
  window.location.href = "healthcarelogin.html";
  </script>';   //user already exists  //DISPLAY USER ALREADY EXISTS ALERT
}

mysqli_close($conn);

?>