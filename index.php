<?php 
    session_start(); 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

?> 
<!DOCTYPE html> 
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <title> Pahampang Tabulation System </title>
    </head>
    <body>
        <div class="wrap">
            <nav class="navigate">
                <ul>
                    <li id="active"> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home</p></a></li>
                    <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking</p></a></li>
                    <li> <p id="space"></p></li>
                    <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results</p></a></li>
                    <li><a href="#"><p> <i class="fa fa-user fa-2x"></i> Login </p></a>
                        <ul>
                            <li> <a href="loginJudge.php"> Judge </a></li>
                            <li> <a href="loginSponsor.php"> Sponsor</a></li>
                            <li> <a href="loginAdmin.php"> Admin </a></li>
                        </ul>
                    </li>
                </ul>
                <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            </nav>
            <h1 id="title"> Pahampang Tabulation System</h1>
            <img src="images/header.png" id="header" title="(c)http://www.lboro.ac.uk/research/sti/about/media-centre/#"><br/>
        </div>
        
        <footer class="footer">
            <div class="logos">
            <div id="acadLogo">
                <img src="images/Clovers.png" title="Clovers" alt="Clovers"> Clovers
            </div>
            <div id="acadLogo">
                <img src="images/Elektrons.png" title="Elektrons" alt="Elektrons"> Elektrons
            </div>
            <div id="acadLogo">
                <img src="images/Fisheries.png" title="Fisheries" alt="Fisheries"> Fisheries
            </div>
            <div id="acadLogo">
                <img src="images/Magnates.png" title="Magnates" alt="Magnates"> Magnates
            </div>
            <div id="acadLogo">
                <img src="images/Redbolts.png" title="Redbolts" alt="Redbolts"> Redbolts
            </div>
            <div id="acadLogo">
                <img src="images/Scions.png" title="Scions" alt="Scions"> Scions
            </div>
            <div id="acadLogo">
                <img src="images/Skimmers.png" title="Skimmers" alt="Skimmers"> Skimmers
            </div>
            <div id="acadLogo">
                <img src="images/SoTech.png" title="SoTech" alt="SoTech"> SoTech
            </div>
            <div id="acadLogo">
                <img src="images/Tycoons.png" title="Tycoons" alt="SoTech"> Tycoons
            </div>
            <div id="acadLogo">
                <img src="images/Ugyon.png" title="Ugyon" alt="Ugyon"> Ugyon
            </div>
            </div>
            <p id="foot"> <i class="fa fa-envelope"></i> <a href="upv.usc1516@gmail.com">upv.usc1516@gmail.com </a></p>
            <p id="foot"> Pahampang Tabulation System</p>
            <p id="foot"> UPV University Student Council (c) 2015</p>   
        </footer>
        
   
    </body>
</html>
