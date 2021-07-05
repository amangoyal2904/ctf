<?php require'partials/_dbconnect.php' 
?>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login1.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $usernamer=$_SESSION['username'];
    $username=str_replace("<","&lt;",$username);
    $username=str_replace(">","&gt;",$username);
    $sql="SELECT * FROM `registered` WHERE `username`='$username' AND `status`='ACTIVE'";
    $result=mysqli_query($conn,$sql);
    $num1=mysqli_num_rows($result);
    if($num1>0){
        $_SESSION['username_exists']=true;
        
    }
    else{$sql="UPDATE `registered` SET `username` = '$username' WHERE `registered`.`username` = '$usernamer'";
    $_SESSION['username']=$username;
    $result=mysqli_query($conn,$sql);
    }
    header("location: profile.php");
}
?>