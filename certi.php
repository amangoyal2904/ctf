<?php require'partials/_dbconnect.php' ?>
<?php
session_start();
$token=$_GET['token'];
$sql="SELECT * FROM `registered` WHERE `token`='$token' AND `Certificate`='Yes'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
if($num!=0){
$row=mysqli_fetch_assoc($result);
//header('content-type:image/jpeg');
$usernamer=$row['name'];
 $font=realpath('OpenSans-Bold.ttf');
        $image=imagecreatefromjpeg("format.jpg");
        $color=imagecolorallocate($image,128,0,0);
        if(strlen($usernamer)<6){
        imagettftext($image,35,0,725,540,$color,$font,$usernamer);
        }
        else if(strlen($usernamer)<12){
          imagettftext($image,35,0,675,540,$color,$font,$usernamer);
       }
       else if(strlen($usernamer)<19){
        imagettftext($image,35,0,625,540,$color,$font,$usernamer);
       }
       else{
        imagettftext($image,35,0,575,540,$color,$font,$usernamer);
       }
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
           header('content-type:image/jpeg');
         imagejpeg($image);
       imagedestroy($image);
      }
       else{
          
         $file_path="certif/".$token.".jpg";
        imagejpeg($image,$file_path);
       imagedestroy($image);
       require('fpdf.php');
       $pdf=new FPDF();
       $pdf->AddPage();
       $pdf->Image($file_path,0,0,240,200);
       $pdf->Output();
       }
}
else{
    echo'<h1>Error 404</h1>
         <p style="font-size:20px;">The page you are looking for does not exist.';
}
?>