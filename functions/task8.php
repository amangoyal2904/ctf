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
    $twentyone=$_POST["twentyone"];
    $twentyone=str_replace("<","&lt;",$twentyone);
    $twentyone=str_replace(">","&gt;",$twentyone);
    $twentyone=str_replace('"','&#34',$twentyone);
    $twentytwo=$_POST["twentytwo"];
    $twentytwo=str_replace("<","&lt;",$twentytwo);
    $twentytwo=str_replace(">","&gt;",$twentytwo);
    $twentytwo=str_replace('"','&#34',$twentytwo);
    $twentythree=$_POST["twentythree"];
    $twentythree=str_replace("<","&lt;",$twentythree);
    $twentythree=str_replace(">","&gt;",$twentythree);
    $usernamer=$_SESSION['username'];
    $score8=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$twentyone' WHERE `$token`.`qid` = 21";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=21 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twentyone)) $score8+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$twentytwo' WHERE `$token`.`qid` = 22";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=22 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twentytwo)) $score8+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$twentythree' WHERE `$token`.`qid` = 23";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=23 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twentythree)) $score8+=1;
    }
    $sql="UPDATE `registered` SET `score8` = '$score8' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
     header("location: ../home.php");
}
    ?>
