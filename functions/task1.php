<?php require'../partials/_dbconnect.php' ?>
<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $one=$_POST["one"];
    $one=str_replace("<","&lt;",$one);
    $one=str_replace(">","&gt;",$one);
    $two=$_POST["two"];
    $two=str_replace("<","&lt;",$two);
    $two=str_replace(">","&gt;",$two);
    $three=$_POST["three"];
    $three=str_replace("<","&lt;",$three);
    $three=str_replace(">","&gt;",$three);
    $usernamer=$_SESSION['username'];
    $score1=0;
    echo "hello";
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $sql="UPDATE `$token` SET `selection` = '$one' WHERE `$token`.`qid` = 1";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=1 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($one)){
            $score1+=1;
            ?>
            <script>
            let task1=getElementById('task1');
            task1.style.border-color=green;
            </script>
            <?php
        }
    }
    $sql="UPDATE `$token` SET `selection` = '$two' WHERE `$token`.`qid` = 2";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=2 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($two)) $score1+=1;
    }
    $sql="UPDATE `$token` SET `selection` = '$three' WHERE `$token`.`qid` = 3";
    $result=mysqli_query($conn,$sql);
    $sql="SELECT * FROM `questions` WHERE `qid`=3 ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        if(strtolower($row['answer'])==strtolower($three)) $score1+=1;
    }
    $sql="UPDATE `registered` SET `score1` = '$score1' WHERE `registered`.`username` = '$usernamer'";
    $result=mysqli_query($conn,$sql);
    header("location: ../home.php");
}
    ?>
