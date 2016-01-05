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

    $sponsor_ID = $_GET['sponsor_ID'];

    $querSponsor = "SELECT sponsorName 
                        FROM sponsor
                            WHERE sponsor_ID=$sponsor_ID";
    $resSponsor= mysqli_query($dbconn, $querSponsor);
    $rowSponsor = mysqli_fetch_assoc($resSponsor); 


    $querEvents = "SELECT event_ID, eventName 
                        FROM contestevent JOIN (SELECT event_ID FROM eventSponsor WHERE sponsor_ID=$sponsor_ID) AS sponsorship USING (event_ID) ";
    $resEvents = mysqli_query($dbconn, $querEvents);
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Sponsor</title>
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <style>
            .contest{
                width:770px;
            }
        </style>
    </head>
    <body>
    	<nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li id="active"> <a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="sponsors.php"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a><br/>
            </div>
        </nav>  
                             
        <div class="content">
            <div class="leftPanel">
                <div class="admin">
                    <a href="events.php"> Events </a><br/>
                    <a href="createEvent.php"> Create Event </a><br/>
                    <a href="sponsors.php" id="activeTab">Sponsorsoring Organizations </a><br/>
                    <a href="createSponsor.php"> Register Sponsor </a>
                </div>
            </div>
            <div class="middlePanel">
                <div class="panelHeadAdmin">
                    <h2 id="panelTitle"> <?php echo  $rowSponsor['sponsorName'] ?> </h2>  
                </div>
                <div class="contest">
                    <h3> Events </h3>
                    <table>
                        <?php
                            while($rowEvents = mysqli_fetch_assoc($resEvents)){
                        ?>
                        <tr>
                            <td style="width:250px"><?php echo $rowEvents['eventName'] ?></td>
                            <td><a href="removeEvent.php?event_ID=<?php echo $rowEvents ['event_ID'] ?>&sponsor_ID=<?php echo $sponsor_ID ?>" id="delete"><i class="fa fa-times" title="Remove"></i></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table><br/>
                    <li><a href="addEvent.php?sponsor_ID=<?php echo $sponsor_ID ?>"> Add Event </a></li>
                </div>
            </div>
            <div class="rightContent">
            </div>
        </div>
    </body>
</html>