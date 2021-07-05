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
    $ten=$_POST["ten"];
    $ten=str_replace("<","&lt;",$ten);
    $ten=str_replace(">","&gt;",$ten);
    $eleven=$_POST["eleven"];
    $eleven=str_replace("<","&lt;",$eleven);
    $eleven=str_replace(">","&gt;",$eleven);
    $twelve=$_POST["twelve"];
    $twelve=str_replace("<","&lt;",$twelve);
    $twelve=str_replace(">","&gt;",$twelve);
    $usernamer=$_SESSION['username'];
    $score4=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$ten' WHERE `$token`.`qid` = 10";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=10 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if($row['answer']==$ten) $score4+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$eleven' WHERE `$token`.`qid` = 11";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=11 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($eleven)) $score4+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$twelve' WHERE `$token`.`qid` = 12";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=12 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($twelve)) $score4+=1;
    }
    $sql="UPDATE `registered` SET `score4` = '$score4' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
     header("location: ../home.php");
}
    ?>
