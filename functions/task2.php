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
    $four=str_replace("<","&lt;",$four);
    $four=str_replace(">","&gt;",$four);
    $five=$_POST["five"];
    $five=str_replace("<","&lt;",$five);
    $five=str_replace(">","&gt;",$five);
    $six=$_POST["six"];
    $six=str_replace("<","&lt;",$six);
    $six=str_replace(">","&gt;",$six);
    $usernamer=$_SESSION['username'];
    $score2=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$four' WHERE `$token`.`qid` = 4";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=4 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($four)) $score2+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$five' WHERE `$token`.`qid` = 5";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=5 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($five)) $score2+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$six' WHERE `$token`.`qid` = 6";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=6 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($six)) $score2+=1;
    }
    $sql="UPDATE `registered` SET `score2` = '$score2' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
     header("location: ../home.php");
}
    ?>
