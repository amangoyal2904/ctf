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
    $eighteen=$_POST["eighteen"];
    $eightteen=str_replace("<","&lt;",$eightteen);
    $eightteen=str_replace(">","&gt;",$eightteen);
    $nineteen=$_POST["nineteen"];
    $nineteen=str_replace("<","&lt;",$nineteen);
    $nineteen=str_replace(">","&gt;",$nineteen);
    $nineteen=str_replace('"','&#34',$nineteen);
    $twenty=$_POST["twenty"];
    $twenty=str_replace("<","&lt;",$twenty);
    $twenty=str_replace(">","&gt;",$twenty);
    $usernamer=$_SESSION['username'];
    $score7=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$eighteen' WHERE `$token`.`qid` = 18";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=18 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($eighteen)) $score7+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$nineteen' WHERE `$token`.`qid` = 19";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=19 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($nineteen)) $score7+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$twenty' WHERE `$token`.`qid` = 20";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=20 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twenty)) $score7+=1;
    }
    $sql="UPDATE `registered` SET `score7` = '$score7' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
     header("location: ../home.php");
}
    ?>
