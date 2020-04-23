<?php
session_start();

$email = $_GET['email'];
$password = $_GET['password'];

$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");


$myquery1 = "SELECT * FROM `userlogin` WHERE  email='$email' AND password='$password';";
$query = mysqli_query($conn,$myquery1);

$row = mysqli_fetch_array($query);


$data = $row[0];


$arr = array();
if($data){
	$querynew =  mysqli_query($conn,"SELECT * FROM `userlogin` WHERE  email='$email' AND password='$password';");
		while ($row = mysqli_fetch_assoc($querynew))
   	   {
          $name = $row['name'];
          $arr[] = array('name' => $name);
       }		    
      //   header('Content-Type: application/json');
       $_SESSION['name'] = $name;
       $_SESSION['email']= $email;
       $_SESSION['password'] = $password;

       echo '<script>window.location.href = "userhome.php"</script>';
    //  echo json_encode($arr);	
         //CHANGE LOCATION TO HCW HOME
      // exit;

}else{              //INVALID DETAILS REDIRECT TO SAME PAGE--- WORKING
	echo '<script>alert("Invalid Email or Password");
  window.location.href = "nav.html";
  </script>'; 
}

mysqli_close($conn);

?>