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
    $thirteen=$_POST["thirteen"];
    $thirteen=str_replace("<","&lt;",$thirteen);
    $thirteen=str_replace(">","&gt;",$thirteen);
    $fourteen=$_POST["fourteen"];
    $fourteen=str_replace("<","&lt;",$fourteen);
    $fourteen=str_replace(">","&gt;",$fourteen);
    $usernamer=$_SESSION['username'];
    $score5=0;
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$thirteen' WHERE `$token`.`qid` = 13";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=13 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($thirteen)) $score5+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$fourteen' WHERE `$token`.`qid` = 14";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=14 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($fourteen)) $score5+=1;
    }
    $sql="UPDATE `registered` SET `score5` = '$score5' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
  //  echo $score5;
     header("location: ../home.php");
}
    ?>
