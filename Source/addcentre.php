<?php

$name = $_GET['name'];
$id = $_GET['id'];
$location = $_GET['address'];
$daylimit = $_GET['daylimit'];


$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");


	$Sql = "INSERT INTO `centre` values ('$id','$location','$daylimit','$name');";
		
		if (mysqli_query($conn, $Sql))
              {
               		echo '<script>alert("New Centre added to Database");
  window.location.href = "hcwhome.php";
  </script>';  //successful  
               }
           else{
               echo '<script>alert("Please Try again after sometime!");
  window.location.href = "hcwhome.php";
  </script>';  //signup failed 
 			}  

mysqli_close($conn);

?>