<?php


$aadhar = $_POST['aadhar'];


$conn = mysqli_connect("localhost","root","","poshaan_abhyaan") or die("Conn failed");


$myquery1 = "SELECT * FROM `userdetails` WHERE  aadhar='$aadhar';";
$query = mysqli_query($conn,$myquery1);

$row = mysqli_fetch_array($query);

$data = $row[0];

$arr = array();
if($data){
  $querynew =  mysqli_query($conn,"SELECT * FROM `userdetails` WHERE  aadhar='$aadhar';");
    while ($row = mysqli_fetch_array($querynew))
       {

          $name= $row["name"];
          $email= $row["email"];
          $phone= $row["phone"];
          $dob= $row["DOB"];
          $address= $row["address"];

          $arr[] = array('name' => $name,'email'=>$email,'phone'=>$phone,'dob'=>$dob,'address'=>$address);
       }        
       header('Content-Type: application/json');
       echo json_encode($arr);  
       //header("Location: hcwhome.html");  //CHANGE LOCATION TO HCW HOME
      

}else{              //INVALID DETAILS REDIRECT TO SAME PAGE--- WORKING
  echo '<script>alert("User not found");
  window.location.href = "hcwhome.html";
  </script>'; 
}

mysqli_close($conn);

?>


/* <div class="users">
  <div class="search-container">
    <form action="">
      <input type="text" placeholder="Enter Aadhar Number" name="search" id="searchvalue">  
      <button id="searchuser">Search user</button>
    </form>
  </div><br>
  <form method="post" action="/" id="form" class="validate">
  <div class="form-field">
    <label>Name</label>
    <input type="text" id="full-name" placeholder="Joe Bloggs" readonly="" />
  </div>
  <div class="form-field">
    <label>Email</label>
    <input type="email" id="email-input" placeholder="example@domain.com" readonly="" />
  </div>
  <div class="form-field">
    <label >Phone</label>
    <input type="text" id="phone-input" readonly="" />
  </div>
  <div class="form-field">
    <label>DOB</label>
    <input type="text" id="dob-input" readonly="" />
  </div>
  <div class="form-field">
    <label >Address</label>
    <input type="text" id="address-input" readonly="" />
  </div>
 <div class="button">
  <button>Add Notes</button>
 </div>
</form>
</div>*/