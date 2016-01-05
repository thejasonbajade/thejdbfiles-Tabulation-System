<?php 
    session_start(); 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    if(!isset($_SESSION['judge_ID']))
    {
        header("Location:loginJudge.php");
    }

    $judge_ID = $_GET['judge_ID'];

    $querJudgeName = "SELECT CONCAT(firstName, ' ', lastName) AS judgeName 
                        FROM judge 
                            WHERE judge_ID=$judge_ID";
    $resJudgeName= mysqli_query($dbconn, $querJudgeName);
    $rowJudgeName = mysqli_fetch_assoc($resJudgeName);

    $querEvent = "SELECT event_ID, eventName 
                    FROM contestevent JOIN (SELECT event_ID FROM judgeevent WHERE judge_ID=$judge_ID) AS judges USING(event_ID) ";
    $resEvent = mysqli_query($dbconn, $querEvent);
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Judge</title>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home</p>  </a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking</p> </a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results</p></a> </li>
                <li  id="active"><a href="logoutJudge.php"><p> <i class="fa fa-user fa-2x"></i> Judge Logout </p></a> </li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                <a href="judgePage.php?judge_ID=<?php echo $judge_ID?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
    
        <div class="content">
            <div class="leftContent">
                <div class="judge">
                    <h3 style="margin-left:50px;margin-top:50px"><?php echo strtoupper($rowJudgeName['judgeName']) ?></h3>
                </div>
            </div>
            <div class="mainContent">
                <div class="panelHead">
                    <h2 id="panelTitle"> Events </h2>  
                </div>
                 <div class="mainInnerCon">
                    <div class="contest">
                        <?php
                            while($rowEvent = mysqli_fetch_row($resEvent)){ 
                        ?>
                        <a href="judgeEnterEvent.php?judge_ID=<?php echo $judge_ID?>&event_ID=<?php echo $rowEvent[0]?>" style="font-size:17px"> <?php echo $rowEvent[1]?></a><br/>
                        <?php
                            }
    	                ?>
                    </div>
                </div>
            </div>
            <div class="rightContent">
                 
            </div>
        </div>
    </body>
</html>