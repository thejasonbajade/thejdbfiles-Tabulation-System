<?php 
    session_start(); 

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    if(!isset($_SESSION['sponsor_ID']))
    {
        header("Location:loginSponsor.php");
    }

    $sponsor_ID = $_GET['sponsor_ID'];

    $querSponsorName = "SELECT sponsorName 
                            FROM sponsor
                                WHERE sponsor_ID=$sponsor_ID";
    $resSponsorName= mysqli_query($dbconn, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querEvents = "SELECT event_ID, eventName 
                        FROM contestevent 
                            JOIN (SELECT event_ID FROM eventSponsor WHERE sponsor_ID=$sponsor_ID) AS sponsorship USING (event_ID) ";
    $resEvents = mysqli_query($dbconn, $querEvents);

?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Sponsor</title>
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
    	<nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home</p>  </a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking</p> </a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results</p></a> </li>
                <li  id="active"><a href="logoutSponsor.php"><p> <i class="fa fa-user fa-2x"></i> Sponsor Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
        </nav>

        <div class="content">
            <div class="leftContent">
                <div class="events">
                    <h3 id="orgName"><?php echo strtoupper($rowSponsorName['sponsorName']) ?></h3>
                    <ul class="leftInfo">
                        <?php 
                            while($rowEvents = mysqli_fetch_assoc($resEvents)){
                        ?>
                                <li><a href="sponsorPage.php?sponsor_ID=<?php echo $sponsor_ID ?>&event_ID=<?php echo $rowEvents['event_ID']?>" id="<?php echo $active ?>"> <?php echo $rowEvents['eventName']?> </a> </li>
                        <?php
                            }
                        ?>  
                    </ul>
               
                </div>
            </div>
            <div class="mainContent">
            </div>
            <div class="rightContent">
            </div>
        </div>
    </body>
</html>