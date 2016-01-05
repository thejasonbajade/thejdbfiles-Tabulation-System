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

    $message = '';

    $querSponsor = "SELECT sponsorName, sponsor_ID 
                        FROM sponsor";
    $resSponsor = mysqli_query($dbconn, $querSponsor);

?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Sponsoring Organization </title>  
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li id="active"> <a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="adminPage.php"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
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
                        <h2 id="panelTitle"> Sponsors </h2>  
                </div>
                <div class="middleContent">
                    <table style="margin-left:200px;margin-top:30px">
                        <?php
                            while($rowSponsor = mysqli_fetch_assoc($resSponsor)){
                        ?>
                        <tr> 
                            <td style="width:300px"> <a href="viewSponsor.php?sponsor_ID=<?php echo $rowSponsor['sponsor_ID'] ?>"> <?php echo $rowSponsor['sponsorName'] ?> </a> </td>
                            <td style="width:30px; text-align:center"> <a href="editSponsor.php?sponsor_ID=<?php echo $rowSponsor['sponsor_ID'] ?>" id="edit"> <i class="fa fa-pencil-square-o" title="Edit Event"></i> </a> </td>
                            <td style="width:30px; text-align:center"> <a href="deleteSponsor.php?sponsor_ID=<?php echo $rowSponsor['sponsor_ID'] ?>" id="delete"> <i class="fa fa-trash" title="Delete Event"></i></a> </td>
                        </tr>    
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>