<?php require'partials/_dbconnect.php' ?>
<?php echo'
    <div class="leaderboard" style="display:inline-block;">
    
    <div class="topper">Top Performers</div>
    <table style="">
    <thead>
    <tr>
    <th>user</th>
    <th>score</th>
    </tr>
    </thead>
    <tbody>';
    
    $sql="SELECT * FROM `registered` WHERE `status`='ACTIVE' ORDER BY `score` DESC";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num>10) $num=10;
    for($i=0;$i<$num;$i++){
        $row=mysqli_fetch_assoc($result);
        echo "<tr>
        <td>".$row['email']."</td>
        <td>".$row['Score']."</td>
        </tr>";
    }
    
    echo '</tbody>
    <table>
    </div>';?>
