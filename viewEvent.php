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

    $event_ID = $_GET['event_ID'];

    $querEventName = "SELECT eventName, eventCode, date 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName); 

    $querVenue= "SELECT venueName 
                    FROM venue JOIN (SELECT venue_ID FROM contestevent WHERE event_ID = $event_ID) AS contest USING (venue_ID)"; 
    $resVenue = mysqli_query($dbconn, $querVenue);
    $rowVenue = mysqli_fetch_assoc($resVenue);


    $querContest = "SELECT contestName, contest_ID 
                        FROM specificcontest 
                            WHERE event_ID=$event_ID";
    $resContest = mysqli_query($dbconn, $querContest);

    $querJudges = "SELECT CONCAT(firstname, ' ', lastname) AS name 
                        FROM judge JOIN (SELECT judge_ID FROM judgeevent WHERE event_ID = $event_ID) AS judges USING(judge_ID)";
    $resJudges = mysqli_query($dbconn, $querJudges);

    $querSponsor = "SELECT sponsorName, sponsor_ID 
                        FROM sponsor JOIN (SELECT sponsor_ID FROM eventsponsor WHERE event_ID=$event_ID) AS sponsorship  USING(sponsor_ID)  ";
    $resSponsor = mysqli_query($dbconn, $querSponsor);

?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Events</title>
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
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home</p>  </a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking</p> </a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results</p></a> </li>
                <li id="active"> <a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="events.php"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a><br/>
            </div>
        </nav>
                             
        <div class="content">
            <div class="leftPanel">
                <div class="admin">
                    <a href="events.php" id="activeTab"> Events </a><br/>
                    <a href="createEvent.php"> Create Event </a><br/>
                    <a href="sponsors.php">Sponsorsoring Organizations </a><br/>
                    <a href="createSponsor.php"> Register Sponsor </a>
                </div>
            </div>
            <div class="middlePanel">
                <div class="panelHeadAdmin">
                    <h2 id="panelTitle"> <?php echo  $rowEventName['eventName'] ?> </h2>  
                </div>
                <div class="contest">
                    <h3> Event Code </h3>
                    <ul>
                        <li> <?php echo  $rowEventName['eventCode'] ?> </li>
                    </ul>
                </div>
                <div class="contest">
                     <h3> Date </h3>
                    <ul>
                        <li> <?php echo  date('F j , Y', strtotime(str_replace('-','/',$rowEventName['date']))) ?> </li>
                    </ul>
                </div>
                <div class="contest">
                    <h3> Venue </h3>
                    <ul>
                        <li> <?php echo $rowVenue['venueName'] ?> </li>
                    </ul>
                </div>
                <div class="contest">
                    <h3> Specific Contests and Criteria </h3>
                    <ul>
                        <?php
                            while($rowContest = mysqli_fetch_assoc($resContest)){
                                 $contest_ID = $rowContest['contest_ID'];
                        ?>
                        <li> <h4> <?php echo $rowContest['contestName'] ?> </h4>
                            <ul>
                                <li> <a href="viewScoresView.php?event_ID=<?php echo $event_ID?>&contest_ID=<?php echo $contest_ID ?>" id="listLink"> View Scores </a></li>
                                <li>  Criteria
                                    <table style="width:300px">
                                        <tbody>
                                            <?php
                                                $querCriteria = "SELECT criterion, percentage, cri_ID 
                                                                    FROM criteria JOIN (SELECT cri_ID, percentage FROM criteriacon WHERE contest_ID=$contest_ID) AS criPercentage USING(cri_ID)"; //get criteria each contest
                                                $resCriteria = mysqli_query($dbconn, $querCriteria);
                                                while($rowCriteria = mysqli_fetch_assoc($resCriteria)){ 
                                            ?>
                                            <tr>
                                                <td> <?php echo $rowCriteria['criterion'] ?> </td>
                                                <td> <?php echo $rowCriteria['percentage']?>% </td>
                                            </tr>
                                            <?php
                                               }
                                            ?>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
                        </li>
                        <?php
                             }
                        ?>
                    </ul>
                </div>
                <div class="contest">
                    <h3>Judges</h3>
                    <ul>
                        <?php
                            while($rowJudges = mysqli_fetch_assoc($resJudges)){ 
                        ?>
                        <li> <?php echo $rowJudges['name']?> </li>          
                        <?php
                            }
                        ?>
                    </ul>
                </div>
                 <div class="contest">
                    <h3> Sponsoring Organizations </h3>
                    <table>
                        <tbody>
                        <?php
                            while($rowSponsor = mysqli_fetch_assoc($resSponsor)){ 
                        ?>
                            <tr>
                                <td style="width:250px"> <?php echo $rowSponsor['sponsorName']?> </td>
                                <td> <a href="removeSponsor.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $rowSponsor['sponsor_ID'] ?>" id="delete"><i class="fa fa-times" title="Remove"></i></a></td>
                            </tr>
                        <?php
                            }
                        ?>

                        </tbody>
                    </table><br/>
                    <li> <a href="addSponsor.php?event_ID=<?php echo $event_ID ?>" id="listLink"> Add Sponsor </a></li>
                </div>
            </div>
            <div class="rightContent">       
            </div>
        </div>
    </body>
</html>