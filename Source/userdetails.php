<?php
session_start();

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];

$aadhar = $_GET['aadhar'];
$dob = $_GET['dob'];
$address = $_GET['address'];
$phone = $_GET['phno'];


$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");

//check if user already exists
//if not insert into table (acc to type) values

$query = mysqli_query($conn,"SELECT * FROM `userdetails` WHERE email='$email';");
$row = mysqli_fetch_array($query);
$data = $row[0];
if(!$data){
	$Sql = "INSERT INTO `userdetails` values ('$name','$aadhar','$email','$password','$dob','$address','$phone');";
		
		if (mysqli_query($conn, $Sql))
              {
               		 echo '<script>alert("Updated Successfully");
  					window.location.href = "userhome.php";
 					 </script>';
                //  header('location : userhome.php'); //signup successful  //GO TO HEALTHCARE WORKER HOME PAGE
               }
           else{
               echo '<script>alert("Please Try again after sometime!");
  					window.location.href = "userhome.php";
 				 </script>';  //signup failed 
 			}  
}else{
	echo '<script>alert("Data already Updated, Please Continue");
  window.location.href = "userhome.php";
  </script>';   //user already exists  //DISPLAY USER ALREADY EXISTS ALERT
}

mysqli_close($conn);

?>