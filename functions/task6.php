<?php
$servername="localhost";
$username="root";
$password="";
$database="users";
$conn=mysqli_connect($servername,$username,$password,$database);
?>
<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $fifteen=$_POST["fifteen"];
    $fifteen=str_replace("<","&lt;",$fifteen);
    $fifteen=str_replace(">","&gt;",$fifteen);
    $sixteen=$_POST["sixteen"];
    $sixteen=str_replace("<","&lt;",$sixteen);
    $sixteen=str_replace(">","&gt;",$sixteen);
    $seventeen=$_POST["seventeen"];
    $seventeen=str_replace("<","&lt;",$seventeen);
    $seventeen=str_replace(">","&gt;",$seventeen);
    $usernamer=$_SESSION['username'];
    $score6=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$fifteen' WHERE `$token`.`qid` = 15";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=15 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($fifteen)) $score6+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$sixteen' WHERE `$token`.`qid` = 16";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=16 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($sixteen)) $score6+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$seventeen' WHERE `$token`.`qid` = 17";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=17 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($seventeen)) $score6+=1;
    }
    $sql="UPDATE `registered` SET `score6` = '$score6' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
     header("location: ../home.php");
}
    ?>
