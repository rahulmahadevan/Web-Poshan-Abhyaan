<?php
session_start();

$email = $_GET['email'];
$password = $_GET['password'];
$name = $_GET['name'];


$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");

//check if user already exists
//if not insert into table (acc to type) values

$query = mysqli_query($conn,"SELECT * FROM `userlogin` WHERE email='$email';");
$row = mysqli_fetch_array($query);
$data = $row[0];
if(!$data){
	$Sql = "INSERT INTO `userlogin` values ('$name','$email','$password');";
		
		if (mysqli_query($conn, $Sql))
              {
               		$_SESSION['name'] = $name;
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                  echo '<script>alert("Sign Up Successful. Please Fill Profile Details");
  window.location.href = "userhome.php";
  </script>'; //signup successful  
               }
           else{
               echo '<script>alert("Please Try again after sometime!");
  window.location.href = "nav.html";
  </script>';  //signup failed 
 			}  
}else{
	echo '<script>alert("User already exists, Please Login");
  window.location.href = "nav.html";
  </script>';   //user already exists  //DISPLAY USER ALREADY EXISTS ALERT
}

mysqli_close($conn);

?>