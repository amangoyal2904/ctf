<?php require'partials/_dbconnect.php' ?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Score', '% of users'],
          <?php
            $sql="SELECT * FROM `registered` WHERE `score`>=0 AND `score`<6 AND `status`='ACTIVE'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            echo "['Between 0-5',".$num."],";
            $sql="SELECT * FROM `registered` WHERE `score`>=6 AND `score`<11 AND `status`='ACTIVE'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            echo "['Between 6-10',".$num."],";
            $sql="SELECT * FROM `registered` WHERE `score`>=11 AND `score`<16 AND `status`='ACTIVE'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            echo "['Between 11-15',".$num."],";
            $sql="SELECT * FROM `registered` WHERE `score`>=16 AND `score`<21 AND `status`='ACTIVE'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            echo "['Between 16-20',".$num."],";
            $sql="SELECT * FROM `registered` WHERE `score`>=21 AND `score`<26 AND `status`='ACTIVE'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            echo "['Between 21-25',".$num."],";
            $sql="SELECT * FROM `registered` WHERE `score`>=26 AND `score`<31 AND `status`='ACTIVE'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            echo "['Between 26-30',".$num."]";
            ?>
        ]);

        var options = {
          title: 'Users percentage With Score',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 600px; height: 500px;position:relative;left:50%;margin-left:-300px;;"></div>
  </body>
</html>