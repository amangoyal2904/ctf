<?php require'partials/_dbconnect.php' ?>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login1.php");
    exit;
}
$usernamer=$_SESSION['username'];
$sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$score1=$row['score1'];
$score2=$row['score2'];
$score3=$row['score3'];
$score4=$row['score4'];
$score5=$row['score5'];
$score6=$row['score6'];
$score7=$row['score7'];
$score8=$row['score8'];
$score9=$row['score9'];
$score10=$row['score10'];
$token=$row['token'];
$sql="UPDATE `registered` SET `score`=$score1+$score2+$score3+$score4+$score5+$score6+$score7+$score8+$score9+$score10 WHERE `username`='$usernamer' AND `status`='ACTIVE'";
$result=mysqli_query($conn,$sql);
$sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$score=$row['Score'];
$sql="SELECT * FROM `$token`";
$result=mysqli_query($conn,$sql);
$ultra=array("hello","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
$i=0;
while($row=mysqli_fetch_assoc($result)){
    $ultra[$i]=$row['selection'];
    $i+=1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs|CTF-OWASP</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">  
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="collapse.js"></script>
</head>
<body>

    <?php require'partials/_nav.php' ?>
    <?php
    if($score==27){
        $sql="UPDATE `registered` SET `Certificate` = 'Yes' WHERE `registered`.`username` = '$usernamer'";
        $result=mysqli_query($conn,$sql);
        ?>
        <script>
        swal({
    title: "Congratulations!",
    text: "You have cleared all the tasks successfully.Now go to profile section to get your certificate.",
    icon: "success",
    button: "OK",
  });</script>
        <?php
    }
    ?>
    <div style="text-align:center;" ><a class="challenge_link" href="https://challenges.andyinfosec.com">Click here for challenges</a></div>
    <div id="firsttask" onclick="hide1()">
        <span class="heading">
            IDOR
        </span>
        <span id="score"><?php echo $score1;?>/3</span>

    </div>
   
        <form id="first" action="functions/task1.php" method="post">
            <div class="question"><p>Question 1. &nbsp;&nbsp; Admin's ID</p></div>
            <input type="text" class="answer" name="one" id="task1" value="<?php echo $ultra[0]?>" size=25>
            <div class="question"><p>Question 2. &nbsp;&nbsp; Final URL</p></div>
            <input type="text" class="answer" name="two" id="task2" value="<?php echo $ultra[1]?>" size=25>
            <div class="question"><p>Question 3. &nbsp;&nbsp;Flag</p></div>
            <input type="text" class="answer" name="three" id="task3" value="<?php echo $ultra[2]?>" size=25>  
            <input type="submit" class="submit">
        </form>
        <div id="secondtask" onclick="hide2()">
            <span class="heading">
                Arbitary File
            </span>
        <span id="scor"><?php echo $score2;?>/3</span></div>
            <form id="second" action="functions/task2.php" method="post">
                <div class="question"><p>Question 1. &nbsp;&nbsp; What type of file you can upload?</p></div>
                <input type="text" class="answer" id="task4" name="four" value="<?php echo $ultra[3]?>" size=25>
                <div class="question"><p>Question 2. &nbsp;&nbsp; How will you upload php file?</p></div>
                <select name="five" id="task5" class="answer" >
                <option value="select the option" >Select the option</option>
                    <option value=".jpg.php" <?php if(strtolower($ultra[4])==".jpg.php") echo "selected"?>>.jpg.php</option>
                    <option value=".php.jpg" <?php if($ultra[4]==".php.jpg") echo "selected"?>>.php.jpg</option>
                    <option value=".php" <?php if($ultra[4]==".php") echo "selected"?>>.php</option>
                  </select>
                  <div class="question"><p>Question 3. &nbsp;&nbsp;Flag</p></div>
                  <input type="text" class="answer" id="task6" name="six" value="<?php echo $ultra[5]?>" size=25>
                  <input type="submit" class="submit">
                </form> 
        <div id="secondtask" onclick="hide3()">
            <span class="heading">
                OS Command Injection
            </span>
        <span id="scor"><?php echo $score3;?>/3</span></div>
            <form id="third" method="post" action="functions/task3.php">
                <div class="question"><p>Question 1. &nbsp;&nbsp; Can OS command be injected in the website?</p></div>
                <select name="seven" id="task7" class="answer">
                <option value="select the option">Select the option</option>
                    <option value="yes" <?php if(strtolower($ultra[6])=="yes") echo "selected"?>>YES</option>
                    <option value="no" <?php if(strtolower($ultra[6])=="no") echo "selected"?>>NO</option>
                  </select>
                <div class="question"><p>Question 2. &nbsp;&nbsp; What command will help you read the flag.txt?</p></div>
                <input type="text" class="answer" id="task8" name="eight" value="<?php echo $ultra[7]?>" size=25>
                  <div class="question"><p>Question 3. &nbsp;&nbsp;Flag</p></div>
                  <input type="text" class="answer" id="task9" name="nine" value="<?php echo $ultra[8]?>" size=25>
                <input type="submit" class="submit">
                </form>  
                <div id="firsttask" onclick="hide4()">
        <span class="heading">
            Broken Access Control
        </span>
        <span id="score"><?php echo $score4;?>/3</span>

    </div>
   
        <form id="fourth" method="post" action="functions/task4.php">
            <div class="question"><p>Question 1. &nbsp;&nbsp; Where will you find the disallowed path?</p></div>
            <input type="text" class="answer" id="task10" name="ten" value="<?php echo $ultra[9]?>" size=25>
            <div class="question"><p>Question 2. &nbsp;&nbsp; Can you access it?</p></div>
            <select name="eleven" id="task11" class="answer">
                <option value="select the option">Select the option</option>
                    <option value="yes" <?php if(strtolower($ultra[10])=="yes") echo "selected"?>>YES</option>
                    <option value="no" <?php if(strtolower($ultra[10])=="no") echo "selected"?>>NO</option>
                  </select>
              <div class="question"><p>Question 3. &nbsp;&nbsp;Flag</p></div>
              <input type="text" class="answer" id="task12" name="twelve" value="<?php echo $ultra[11]?>" size=25>
                <input type="submit" class="submit">
              
            </form>
        <div id="secondtask" onclick="hide5()">
            <span class="heading">
                Broken Authentication
            </span>
        <span id="scor"><?php echo $score5;?>/2</span></div>
            <form id="fifth" method="post" action="functions/task5.php">
                <div class="question"><p>Question 1. &nbsp;&nbsp; Does the password reset link expire after changing the Email ?</p></div>
                <select name="thirteen" id="task13" class="answer">
                <option value="select the option">Select the option</option>
                    <option value="yes" <?php if(strtolower($ultra[12])=="yes") echo "selected"?>>YES</option>
                    <option value="no" <?php if(strtolower($ultra[12])=="no") echo "selected"?>>NO</option>
                  </select>
                <div class="question"><p>Question 2. &nbsp;&nbsp; Flag</p></div>
                <input type="text" class="answer" id="task14" name="fourteen" value="<?php echo $ultra[13]?>" size=25>
                <input type="submit" class="submit">
                </form> 
        <div id="secondtask" onclick="hide6()">
            <span class="heading">
            Sensitive Data Exposure
            </span>
        <span id="scor"><?php echo $score6;?>/3</span></div>
            <form id="sixth" method="post" action="functions/task6.php">
                <div class="question"><p>Question 1. &nbsp;&nbsp; Which file was supposed to be deleted by user?</p></div>
                <input type="text" class="answer" id="task15" name="fifteen" value="<?php echo $ultra[14]?>" size=25>
                <div class="question"><p>Question 2. &nbsp;&nbsp; Which is Zen's actual password?</p></div>
                <input type="text" class="answer" id="task16" name="sixteen" value="<?php echo $ultra[15]?>" size=25>
                  <div class="question"><p>Question 3. &nbsp;&nbsp;Flag</p></div>
                  <input type="text" class="answer" id="task17" name="seventeen" value="<?php echo $ultra[16]?>" size=25>
                <input type="submit" class="submit">
                </form>   
                <div id="secondtask" onclick="hide7()">
            <span class="heading">
                XSS
            </span>
        <span id="scor"><?php echo $score7;?>/3</span></div>
            <form id="seventh" method="post" action="functions/task7.php">
                <div class="question"><p>Question 1. &nbsp;&nbsp; Where can you inject XSS?</p></div>
                <input type="text" class="answer" id="task18" name="eighteen" value="<?php echo $ultra[17]?>" size=25>
                <div class="question"><p>Question 2. &nbsp;&nbsp; Which is the payload to show alert("xss")?</p></div>
                <input type="text" class="answer" id="task19" name="nineteen" value="<?php echo $ultra[18]?>" size=25>
                  <div class="question"><p>Question 3. &nbsp;&nbsp;Flag</p></div>
                  <input type="text" class="answer" id="task20" name="twenty" value="<?php echo $ultra[19]?>" size=25>
                <input type="submit" class="submit">
                </form>  
                <div id="firsttask" onclick="hide8()">
        <span class="heading">
            Insecure Deserialization
        </span>
        <span id="score"><?php echo $score8;?>/3</span>

    </div>
   
        <form id="eighth" method="post" action="functions/task8.php">
            <div class="question"><p>Question 1. &nbsp;&nbsp; In which variable the flag is stored?</p></div>
            <input type="text" class="answer" id="task21" name="twentyone" value="<?php echo $ultra[20]?>" size=25>
            <div class="question"><p>Question 2. &nbsp;&nbsp; Which is the flags encoded format?</p></div>
            <input type="text" class="answer" id="task22" name="twentytwo" value="<?php echo $ultra[21]?>" size=25>
              <div class="question"><p>Question 3. &nbsp;&nbsp;Flag</p></div>
              <input type="text" class="answer" id="task23" name="twentythree" value="<?php echo $ultra[22]?>" size=25>
                <input type="submit" class="submit">
              
            </form>
        <div id="secondtask" onclick="hide9()">
            <span class="heading">
                SQL Injection
            </span>
        <span id="scor"><?php echo $score9;?>/4</span></div>
            <form id="ninth" method="post" action="functions/task9.php">
                <div class="question"><p>Question 1. &nbsp;&nbsp; Is this vulnerable to SQL Injection?</p></div>
                <select name="twentyfour" id="task24" class="answer">
                <option value="select the option">Select the option</option>
                    <option value="yes" <?php if(strtolower($ultra[23])=="yes") echo "selected"?>>YES</option>
                    <option value="no" <?php if(strtolower($ultra[23])=="no") echo "selected"?>>NO</option>
                  </select>
                <div class="question"><p>Question 2. &nbsp;&nbsp; Find the number of columns?</p></div>
                <input type="text" class="answer" id="task25" name="twentyfive" value="<?php echo $ultra[24]?>" size=25>
                  <div class="question"><p>Question 3. &nbsp;&nbsp;What is sql version?</p></div>
                  <input type="text" class="answer" id="task26" name="twentysix" value="<?php echo $ultra[25]?>" size=25>
                  <div class="question"><p>Question 4. &nbsp;&nbsp;Flag</p></div>
                  <input type="text" class="answer" id="task27" name="twentyseven" value="<?php echo $ultra[26]?>" size=25>
                <input type="submit" class="submit">
                </form> 
        <div id="secondtask" onclick="hide10()">
            <span class="heading">
                Open Redirect
            </span>
        <span id="scor"><?php echo $score10;?>/3</span></div>
            <form id="tenth" method="post" action="functions/task10.php">
                <div class="question"><p>Question 1. &nbsp;&nbsp; What is your name?</p></div>
                <input type="text" class="answer" id="task21" value="Enter your name" size=25>
                <div class="question"><p>Question 2. &nbsp;&nbsp; Which is your favourite part?</p></div>
                <select name="favourite" id="task22" class="answer">
                    <option value="xss">Broken Authentication</option>
                    <option value="xxe">XXE</option>
                    <option value="sql">SQL</option>
                  </select>
                  <div class="question"><p>Question 3. &nbsp;&nbsp;Flag.</p></div>
                  <input type="text" class="answer" id="task30" name="thirty" value="<?php echo $ultra[29]?>" size=25>
                <input type="submit" class="submit">
                </form>  
                <hr style="margin-top:3vh;">
                <div class="credits">
                <div class="developer">
                Web developers
                <ul>
                <li><a href="https://www.linkedin.com/in/aman-goyal-a66913171/">Aman Goyal</a></li>
                <li><a href="https://www.linkedin.com/in/ashish-poudel-500861193/">Ashish Poudel</a></li>
                </ul>
                </div>
                <div class="creator">
                Creators
                <ul>
                <li><a href="https://www.linkedin.com/in/saharsh-agrawal-146b991b4/">Saharsh Agarwal</a></li></ul>
                <li><a href="https://www.linkedin.com/in/tejashree-patil-04a3b3144/">Tejashree Patil</a></li></ul>
                <li><a href="https://www.linkedin.com/in/pallavi-reddy-410b7418b/">Pallavi Reddy</a></li></ul>
                </div>  
                <script src="border.js"></script>       
                <?php
                    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($result);
                    $score=$row['Score'];
                ?>      
</body>
</html>