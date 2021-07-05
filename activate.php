<?php require'partials/_dbconnect.php' ?>
<?php
    if(isset($_GET['token'])){
        $token=$_GET['token'];
        $sql="UPDATE `registered` SET `status`='ACTIVE' WHERE `token`='$token'";
        $result=mysqli_query($conn,$sql);
        $sql="CREATE TABLE `users`.`$token` ( `qid` INT(25) NOT NULL , `selection` VARCHAR(255) NOT NULL )";
        $result=mysqli_query($conn,$sql);
        $sql="INSERT INTO `$token` (`qid`, `selection`) VALUES ('1', ''), ('2', ''), ('3', ''), ('4', ''), ('5', ''), ('6', '')
        , ('7', ''), ('8', ''), ('9', ''), ('10', ''), ('11', ''), ('12', ''), ('13', ''), ('14', ''), ('15', ''), ('16', ''), ('17', ''), ('18', ''), ('19', ''), ('20', ''), ('21', ''), ('22', '')
        , ('23', ''), ('24', ''), ('25', ''), ('26', ''), ('27', '')";
        $result=mysqli_query($conn,$sql);
        header("location: login1.php");
    }
?>