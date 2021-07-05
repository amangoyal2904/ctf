<?php
$same=false;
include 'partials/_dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $usernamer=$_POST["username"];
  $usernamer=str_replace("<","&lt;",$usernamer);
  $usernamer=str_replace(">","&gt;",$usernamer);
  $pass=$_POST["pass"];
  $pass=str_replace("<","&lt;",$pass);
  $pass=str_replace(">","&gt;",$pass);
  
$sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `password`='$pass' AND `status`='ACTIVE' ";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);

if($num>0){
    $login=true;
    session_start();
    $row=mysqli_fetch_assoc($result);
    $_SESSION['mail']=$row['email'];
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$usernamer;
    $_SESSION['username_exists']=false;
    
    
    header("location: home.php");

}
else if($num==0){
  $same=true;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF OWASP| Login</title>
    <link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<?php
if($same){
  echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry! </strong>Invalid Credentials.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>
<div class="container">
      <div class="row">
          <div class="col-md-12 offset=md-1">
              <div class="row">
                  <div class="col-md-3 register-left">
                      <img src="down-arrow.png">
                      <h3>Join Us</h3>
                      <p>If you have not registered yet,click the button below to Register</p>
                      <a class="alter" href="register1.php">Register</a>
                  </div>
                <div class="col-md-4 register-right">
                    <h2>Login Here</h2>
                    <form class="register-form" action="login1.php" method="post">
                    <div class="form-group"><input type="text" class="form-control" placeholder="Enter the Username" name="username"></div>
                     <div class="form-group"><input type="password" class="form-control" placeholder="Enter password" name="pass"></div>
                    <div class="form-group"><input type="submit" class="btn btn-primary" ></div>
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