<?php require'partials/_dbconnect.php' ?>
<?php

$copy=false;
$copy1=false;
$same=false;
$done=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $mail=$_POST["mail"];
  $mail=str_replace("<","&lt;",$mail);
  $mail=str_replace(">","&gt;",$mail);
  $username=$_POST["username"];
  $username=str_replace("<","&lt;",$username);
  $username=str_replace(">","&gt;",$username);
  $pass=$_POST["pass"];
  $pass=str_replace("<","&lt;",$pass);
  $pass=str_replace(">","&gt;",$pass);
  $cpass=$_POST["cpass"];
  $cpass=str_replace("<","&lt;",$cpass);
  $cpass=str_replace(">","&gt;",$cpass);
  $token=bin2hex(random_bytes(15));
$sql="SELECT * FROM `registered` WHERE `email`='$mail' AND `status`='ACTIVE'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
$sql="SELECT * FROM `registered` WHERE `username`='$username' AND `status`='ACTIVE'";
$result=mysqli_query($conn,$sql);
$num1=mysqli_num_rows($result);
if($num1>0){
  $copy1=true;
}
if($num>0){
  $copy=true;
}
else if($pass!=$cpass){
  $same=true;
}
else if($num1==0) {
  $sql="INSERT INTO `registered` ( `email`,`username`,`password`,`token`, `time_of_registration`,`status`) VALUES ( '$mail','$username', '$pass','$token', current_timestamp(),'INACTIVE')";
  $result=mysqli_query($conn,$sql);
  $done=true;
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF OWASP| Register</title>
    <link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<?php session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  header("location: home.php");
  exit;
}
else{

}
?>
<?php
if($copy){
  echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong> This email is already registered with us.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else if($copy1){
  echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong> This username is already registered with us.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else if($same){
  echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong> Passwords do not match.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else if($done){
$subject = "Verification mail";
$body = "Welcome,$mail.Click the link below to verify your mail.
         http://localhost:8080/ques-ans/activate.php?token=$token";
$headers = "From: amangoyal29041999@gmail.com";

if (mail($mail, $subject, $body, $headers)) {

    ?>
    <script>alert("Check your mail");</script>
    <?php
} else {
  ?>
  <script>alert("Email Sending Failed");</script>
  <?php
}
}
?>
  <div class="container">
      <div class="row">
          <div class="col-md-12 offset=md-1">
              <div class="row">
                  <div class="col-md-3 register-left">
                      <img src="down-arrow.png">
                      <h3>Join Us</h3>
                      <p>If you are already registered,click the button below to login</p>
                      <a class="alter" href="login1.php">Login</a>
                  </div>
                <div class="col-md-4 register-right">
                    <h2>Register Here</h2>
                    <form class="register-form" action="register1.php" method="post">
                    <div class="form-group"><input type="text" class="form-control" placeholder="Enter the Username" name="username"></div>
                    <div class="form-group"><input type="email" class="form-control" placeholder="Enter your email" name="mail"></div>
                    <div class="form-group"><input type="password" class="form-control" placeholder="Enter password" name="pass"></div>
                    <div class="form-group"><input type="password" class="form-control" placeholder="Confirm your password" name="cpass"></div>
                    <div class="form-group"><input type="submit" class="btn btn-primary" placeholder="Register"></div>
                    </form>
                </div> 
                <div class="col-md-4 leader">
                      <div class="header">
                      <i class="fa fa-1.5x fa-trophy"></i>
                      Top Scorers
                      </div>
                      <?php
                      $sql="SELECT * FROM `registered` WHERE `status`='ACTIVE' ORDER BY `score` DESC";
                      $result=mysqli_query($conn,$sql);
                      $num=mysqli_num_rows($result);
                      if($num>5) $num=5;
                      for($i=1;$i<=$num;$i++){
                        $row=mysqli_fetch_assoc($result);
                        echo "<div class='using'>
                        <div class='numbering'>".$i."</div>
                        <div class='naming'>".$row['username']."</div>
                        <div class='scoring'>".$row['Score']."</div>
                        </div>";
                      }
                      ?>
                  </div> 
            </div>
        </div>
    </div>
  </div>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>