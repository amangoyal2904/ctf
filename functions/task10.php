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
    $four=$_POST["four"];
    $five=$_POST["five"];
    $six=$_POST["six"];
    $usernamer=$_SESSION['username'];
    $score10=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$four' WHERE `$token`.`qid` = 4";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=4 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($four)) $score10+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$five' WHERE `$token`.`qid` = 5";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=5 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($five)) $score10+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$six' WHERE `$token`.`qid` = 6";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=6 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($six)) $score10+=1;
    }
    $sql="UPDATE `registered` SET `score10` = '$score10' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
     header("location: ../home.php");
}
    ?>
