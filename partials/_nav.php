<?php

echo '<div id="navbar">
        <div>
            <img src="andy_logo.png" alt="Andy" height=90 width=280>
        </div>';
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
            echo ' <div class="navbaritem" style="margin-left:25vw;" id="home"><a href="home.php">Home</a></div>
            <div class="navbaritem" id="register"><a href="Register.php">Register</a></div>
            <div class="navbaritem" id="login"><a href="login.php">Login</a></div>';
        }
        else{
            echo '<div class="navbaritem" style="margin-left:25vw;" id="home"><a href="home.php">Home</a></div>
            <div class="navbaritem" id="leaderboard"><a href="Leaderboard.php">Leaderboard</a></div>
            <div class="navbaritem" id="logout"><a href="logout.php">Logout</a></div>
            <div class="profile navbaritem" id="profile"><a href="profile.php"><img src="Profile-pic.jpg" alt="profile" width=70 height=70></a></div>';
        }
    echo '</div>';

    ?>