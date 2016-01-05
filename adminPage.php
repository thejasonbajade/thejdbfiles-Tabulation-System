<?php 
    session_start();
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    if(!isset($_SESSION['admin_ID']))
    {
        header("Location:loginAdmin.php");
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Admin </title>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home</p>  </a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li id="active"> <a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
        </nav>
        <div class="content">
            <div class="leftPanel">
                <div class="admin">
                    <a href="events.php"> Events </a><br/>
                    <a href="createEvent.php"> Create Event </a><br/>
                    <a href="sponsors.php">Sponsorsoring Organizations </a><br/>
                    <a href="createSponsor.php"> Register Sponsor </a>
                </div>
            </div>
            <div class="middlePanel">
            </div>
        </div>
    </body>
</html>