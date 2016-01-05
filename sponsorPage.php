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
    $event_ID = $_GET['event_ID'];

    $querSponsorName = "SELECT sponsorName 
                            FROM sponsor
                                WHERE sponsor_ID=$sponsor_ID";
    $resSponsorName= mysqli_query($dbconn, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querEvents = "SELECT event_ID, eventName 
                        FROM contestevent 
                            JOIN (SELECT event_ID FROM eventSponsor WHERE sponsor_ID=$sponsor_ID) AS sponsorship USING (event_ID) ";
    $resEvents = mysqli_query($dbconn, $querEvents);

    $querEventName = "SELECT eventName, judgingSystem , eventCode, date
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    $judgingSystem = ($rowEventName['judgingSystem']==0?'Point':($rowEventName['judgingSystem']==1?'Rank':''));

    $querVenue= "SELECT venueName 
                    FROM venue JOIN (SELECT venue_ID FROM contestevent WHERE event_ID = $event_ID) AS contest USING (venue_ID)"; 
    $resVenue = mysqli_query($dbconn, $querVenue);
    $rowVenue = mysqli_fetch_assoc($resVenue);


    $querContest = "SELECT contestName, contest_ID, main 
                        FROM specificcontest 
                            WHERE event_ID=$event_ID";
    $resContest = mysqli_query($dbconn, $querContest);

    $querJudge = "SELECT judge_ID, CONCAT(firstname, ' ', lastname) AS name 
                    FROM judge JOIN (SELECT judge_ID FROM judgeevent WHERE event_ID = $event_ID) AS judges USING(judge_ID)";
    $resJudge = mysqli_query($dbconn, $querJudge);


    $querSponsor = "SELECT sponsorName 
                FROM sponsor JOIN (SELECT sponsor_ID FROM eventsponsor WHERE event_ID=$event_ID AND sponsor_ID!=$sponsor_ID) AS sponsorship  USING(sponsor_ID)  ";
    $resSponsor = mysqli_query($dbconn, $querSponsor);

    $querContestants = "SELECT acadOrg_ID, name 
                            FROM academicorg JOIN (SELECT acadOrg_ID, orderNum FROM joinevent WHERE event_ID = $event_ID) AS contestants USING(acadOrg_ID) ORDER BY orderNum";
    $resContestants = mysqli_query($dbconn, $querContestants);

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
                                $active = (($event_ID == $rowEvents['event_ID'])?"active":"");
                        ?>
                                <li><a href="sponsorPage.php?sponsor_ID=<?php echo $sponsor_ID ?>&event_ID=<?php echo $rowEvents['event_ID']?>" id="<?php echo $active ?>"> <?php echo $rowEvents['eventName']?> </a> </li>
                        <?php
                            }
                        ?>  
                    </ul>
               
                </div>
            </div>
        <?php
            if($event_ID!=0){
        ?>
            <div class="mainContent">
                <div class="panelHead">
                    <h2 id="panelTitle"> <?php echo  $rowEventName['eventName'] ?> </h2>  
                </div>
                <div class="mainInnerCon">
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
                            <li> <?php echo $rowVenue['venueName'] ?> <a href="addVenue.php?sponsor_ID=<?php echo $sponsor_ID ?>&event_ID=<?php echo $event_ID?>" id="edit" > <i class="fa fa-pencil-square-o" title="Edit Venue"></i></a></li>
                        </ul>
                    </div>
                    <div class="contest">
                        <h3> Specific Contests and Criteria </h3>
                        <ul>
                            <?php
                                while($rowContest = mysqli_fetch_assoc($resContest)){
                                     $contest_ID = $rowContest['contest_ID'];
                            ?>
                            <li> <h4>   <?php 
                                            if($rowContest['main']==1){
                                        ?>
                                        <i class="fa fa-star" style="color:#FFD700"></i>
                                        <?php
                                            }
                                        ?>
                                        <?php echo $rowContest['contestName'] ?>
                                        <a href="deleteContest.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?>&contest_ID=<?php echo $contest_ID ?> " id="delete"><i class="fa fa-trash" title="Delete Contest"></i></a> 
                                        <a href="editContest.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?>&contest_ID=<?php echo $contest_ID ?>" id="edit"><i class="fa fa-pencil-square-o" title="Edit Contest"></i></a>
                                </h4>
                                <ul>
                                    <li> <a href="viewScores.php?event_ID=<?php echo $event_ID?>&contest_ID=<?php echo $contest_ID ?>&sponsor_ID=<?php echo $sponsor_ID?>" id="listLink"> View Scores </a></li>
                                    <li>  Criteria <a href="addCriteria.php?contest_ID=<?php echo $contest_ID?>&event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID?>" id="add"> <i class="fa fa-plus-square" title="Add Criteria"></i> </a>
                                        <?php
                                            $querCriteria = "SELECT criterion, percentage, cri_ID 
                                                                FROM criteria JOIN (SELECT cri_ID, percentage FROM criteriacon WHERE contest_ID=$contest_ID) AS criPercentage USING(cri_ID)"; //get criteria each contest
                                            $resCriteria = mysqli_query($dbconn, $querCriteria);
                                        ?>
                                        <table>
                                            <tbody>
                                                <?php
                                                   while($rowCriteria = mysqli_fetch_assoc($resCriteria)){ 
                                                ?>
                                                <tr>
                                                    <td style="width:250px"> <?php echo $rowCriteria['criterion'] ?> </td>
                                                    <td> <?php echo $rowCriteria['percentage']?>% </td>
                                                    <td> <a href="deleteCriteria.php?contest_ID=<?php echo $contest_ID?>&event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID?>&cri_ID=<?php echo $rowCriteria['cri_ID']?>" id="delete"> <i class="fa fa-times" title="Remove"></i> </a></td>
                                                    <td> <a href="editCriteria.php?contest_ID=<?php echo $contest_ID?>&event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID?>&cri_ID=<?php echo $rowCriteria['cri_ID'] ?>" id="edit"> <i class="fa fa-pencil-square-o" title="Edit Criterion"></i> </a></td>
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
                            <li><a href="addContest.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?>" id="listLink"> Add Contest</a> </li>
                        </ul>
                    </div>
                    <div class="contest">
                        <h3> Judging System </h3>
                        <ul>
                            <li> <?php echo $judgingSystem ?> <a href="editJudgingSystem.php?sponsor_ID=<?php echo $sponsor_ID ?>&event_ID=<?php echo $event_ID?>" id="edit"> <i class="fa fa-pencil-square-o" title="Edit Judging System"></i></a></li>
                        </ul>
                    </div>
                    <div class="contest">
                        <h3>Judges</h3>
                        <table>
                            <?php                                
                                while($rowJudge = mysqli_fetch_assoc($resJudge)){ 
                            ?>
                            <tr>
                                <td style="width:250px"> <?php echo $rowJudge['name']?></td>
                                <td> <a href="removeJudge.php?sponsor_ID=<?php echo $sponsor_ID ?>&judge_ID=<?php echo $rowJudge['judge_ID']?>&event_ID=<?php echo $event_ID ?>" id="delete"> <i class="fa fa-times" title="Remove"></i> </a> </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                        <ul>
                            <li><a href="addJudge.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?>" id="listLink"> Add Judge</a></li>
                        </ul>
                    </div>
                    <div class="contest">
                        <h3> Co-sponsoring Organizations </h3>
                        <ul>
                            <?php
                                while($rowSponsor = mysqli_fetch_assoc($resSponsor)){ 
                            ?>
                            <li> <?php echo $rowSponsor['sponsorName']?> </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="rightContent">
                <div class="contestant">
                    <h3> Contestants </h3>
                    <table>
                        <?php
                            while($rowContestants = mysqli_fetch_assoc($resContestants)){ 
                        ?>
                        <tr>
                            <td style="width:110px"> <?php echo $rowContestants['name'] ?> </td>
                            <td> <a href="removeContestant.php?acadOrg_ID=<?php echo $rowContestants['acadOrg_ID']?>&event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?> " id="delete"><i class="fa fa-times" title="Remove"></i></a></td>
                        </tr>
                        <?php 
                            } 
                        ?>
                    </table>
                    <ul>
                        <li> <a href="manageContestant.php?event_ID=<?php echo $event_ID?>&sponsor_ID=<?php echo $sponsor_ID ?>" id="listLink">Manage</a> </li>
                    </ul>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </body>
</html>