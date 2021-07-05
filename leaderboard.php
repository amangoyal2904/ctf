<?php require'partials/_dbconnect.php' ?>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">  
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
<body>
<?php require'partials/_nav.php' ?>
<table class="content-table">
    <thead>
    <tr>
    <th>Rank</th>
    <th>user</th>
    <th>score</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $sql="SELECT * FROM `registered` WHERE `status`='ACTIVE' ORDER BY `score` DESC";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        $mail=$_SESSION['mail'];
        if($mail=="andyinfosec.ctf@gmail.com"){
            include('chart.php');
        }
        $sql="SELECT * FROM `registered` WHERE `status`='ACTIVE' ORDER BY `score` DESC";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($mail!="andyinfosec.ctf@gmail.com") $num=min($num,10);
        for($i=1;$i<=$num;$i++){
            $row=mysqli_fetch_assoc($result);
            echo "<tr>
            <td>".$i."</td>
            <td>".$row['username']."</td>
            <td>".$row['Score']."</td>
            </tr>";
        }
        
        echo '</tbody>
        </table>
        </div>';?>
        
</body>
</html>