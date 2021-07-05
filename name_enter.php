 <?php require'partials/_dbconnect.php' 
?>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login1.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST["name"];
    $usernamer=$_SESSION['username'];
    $name=str_replace("<","&lt;",$name);
    $name=str_replace(">","&gt;",$name);
    $sql="UPDATE `registered` SET `name` = '$name' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
}
header("location: profile.php");
?> 