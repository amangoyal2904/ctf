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
    $twentyfour=$_POST["twentyfour"];
    $twentyfour=str_replace("<","&lt;",$twentyfour);
    $twentyfour=str_replace(">","&gt;",$twentyfour);
    $twentyfive=$_POST["twentyfive"];
    $twentyfive=str_replace("<","&lt;",$twentyfive);
    $twentyfive=str_replace(">","&gt;",$twentyfive);
    $twentysix=$_POST["twentysix"];
    $twentysix=str_replace("<","&lt;",$twentysix);
    $twentysix=str_replace(">","&gt;",$twentysix);
    $twentyseven=$_POST["twentyseven"];
    $twentyseven=str_replace("<","&lt;",$twentyseven); 
    $twentyseven=str_replace(">","&gt;",$twentyseven);
    $usernamer=$_SESSION['username'];
    $score9=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$twentyfour' WHERE `$token`.`qid` = 24";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=24 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twentyfour)) $score9+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$twentyfive' WHERE `$token`.`qid` = 25";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=25 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twentyfive)) $score9+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$twentysix' WHERE `$token`.`qid` = 26";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=26 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twentysix)) $score9+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$twentyseven' WHERE `$token`.`qid` = 27";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=27 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twentyseven)) $score9+=1;
    }
    $sql="UPDATE `registered` SET `score9` = '$score9' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
     header("location: ../home.php");
}
    ?>
