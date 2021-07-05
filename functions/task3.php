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
    $seven=$_POST["seven"];
    $seven=str_replace("<","&lt;",$seven);
    $seven=str_replace(">","&gt;",$seven);
    $eight=$_POST["eight"];
    $eight=str_replace("<","&lt;",$eight);
    $eight=str_replace(">","&gt;",$eight);
    $nine=$_POST["nine"];
    $nine=str_replace("<","&lt;",$nine);
    $nine=str_replace(">","&gt;",$nine);
    $usernamer=$_SESSION['username'];
    $score3=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$seven' WHERE `$token`.`qid` = 7";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=7 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($seven)) $score3+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$eight' WHERE `$token`.`qid` = 8";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=8 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($eight)) $score3+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$nine' WHERE `$token`.`qid` = 9";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=9 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($nine)) $score3+=1;
    }
    $sql="UPDATE `registered` SET `score3` = '$score3' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
    $score3;
    header("location: ../home.php");
}
    ?>
