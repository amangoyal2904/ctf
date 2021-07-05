<?php require'partials/_dbconnect.php' 
?>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login1.php");
    exit;
}
else{
  
    $usernamer=$_SESSION['username'];
    $sql="SELECT * FROM `registered` WHERE `username`='$usernamer' AND `status`='ACTIVE' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$mail=$row['email'];
$score=$row['Score'];
$certi=$row['Certificate'];
$token=$row['token'];
$name=$row['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<!-- <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css"
  rel="stylesheet"
/> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">  
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
<style>

</style>
</head>
<body>
<?php
if($_SESSION['username_exists']==true){
  $_SESSION['username_exists']=false;
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong> The username already exists.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>
<?php require'partials/_nav.php' 

?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 mt-5 pt-5" >
            <div class="row z-depth-3"  style="border:2px solid red;"> 
                <div class="col-sm-4 rounded-left" style="background-color:rgb(168, 54, 54);">
                    <div class="card-block text-center text-white">
                      <i class="fas fa-user-tie fa-7x mt-5"></i>
                      <h2 class="font-weight-bold mt-4"><?php echo $usernamer?></h2>
                      <a class="edit_modal" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit fa-2x mb-4" style="color:white;"></i></a>
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:black;">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="color:black;">
      <form style="text-align:left;" method="post" action="update.php">
  <div class="form-group">
    <label for="exampleInputEmail1"><strong>Username</strong></label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" name="username">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
                      
                    </div>
                </div>
                <div class="col-sm-8 bg-white rounded-right">
                    <h3 class="mt-10 text-center">Your Details</h3>
                    <hr class="badge-primary mt-0 w-25 " style="margin-left:18vw;">
                    <div class=" d-flex">
                    <span class="font-weight-bold mt-0" style="font-size:1.5rem;">Email:</span>
                    <span class=" mt-0 " style="font-size:1.3rem;margin-left:2vw;padding-top:4px;"><?php echo $mail?></span>
                    </div>
                    <hr>
                    <div class=" d-flex">
                    <span class="font-weight-bold mt-1" style="font-size:1.5rem;">Username:</span>
                    <span class=" mt-1 " style="font-size:1.3rem;margin-left:2vw;padding-top:4px;"><?php echo $usernamer?></span>
                    </div>
                    <hr>
                    <div class=" d-flex">
                    <span class="font-weight-bold mt-1" style="font-size:1.5rem;">Score:</span>
                    <span class=" mt-1 " style="font-size:1.3rem;margin-left:2vw;padding-top:4px;"><?php echo $score?></span>
                    <?php
                    if($certi=='Yes'){
                      if($name!=NULL){
                    echo '<form action="certi.php" method="GET"><input type="hidden" id="token" name="token" value='.$token.'><button class="mt-1 generate" style="margin-left:22vw;padding:5px 4px;outline:none;">Generate Certificate</button></form>';
                      }
                      else{
                    echo '<button class="mt-1 generate" data-toggle="modal" data-target="#nameModal" style="margin-left:22vw;padding:5px 4px;outline:none;">Generate Certificate</button>
                    <div class="modal fade" id="nameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form style="text-align:left;" method="post" action="name_enter.php">
      <div class="form-group">
        <label for="exampleInputname1">Name</label>
        <input type="text" class="form-control" id="exampleInputname1" name="name" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Be careful you can change name only once.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        
      </div>
      </form>
    </div>
  </div>
</div>';
                      }
                        }?>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>