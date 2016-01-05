<?php 
    session_start();
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    $event_ID = $_GET['event_ID'];

    $querCont= "SELECT contestName
                    FROM specificcontest 
                        WHERE event_ID=$event_ID";
    $resCont = mysqli_query($dbconn, $querCont);

    $querjudgeSystem = "SELECT judgingSystem  
                            FROM contestevent WHERE event_ID=$event_ID";
    $resjudgeSystem = mysqli_query($dbconn, $querjudgeSystem);
    $rowjudgeSystem = mysqli_fetch_assoc($resjudgeSystem);

    $order = ($rowjudgeSystem['judgingSystem']==0?'DESC':($rowjudgeSystem['judgingSystem']==1?'ASC':''));
    $basis = ($rowjudgeSystem['judgingSystem']==0?'total':($rowjudgeSystem['judgingSystem']==1?'rank':''));
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Contest Results</title>
        <link rel="stylesheet" type="text/css" href="css/overallTable.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li id="active"> <a href="#"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a> 
                <li><a href="#"><p> <i class="fa fa-user fa-2x"></i> Login </p></a>
                    <ul>
                        <li> <a href="loginJudge.php"> Judge  </a></li>
                        <li> <a href="loginSponsor.php"> Sponsor </a></li>
                        <li> <a href="loginAdmin.php"> Admin </a></li>
                    </ul>
                </li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon"> 
                <a href="index.php"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a><br/>
            </div>
        </nav>
       
        <div class="content" style="display: table; margin-top:70px">
            <div class="leftContent" style="display: table-cell">
                <div class="events">
                    <?php 
                        $query = "SELECT event_ID, eventName 
                                    FROM contestevent ";
                        $result = mysqli_query($dbconn, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            $active = (($event_ID == $row['event_ID'])?"active":"");
                    ?>
                    <a href="contestResult.php?event_ID=<?php echo $row['event_ID'] ?>" id="<?php echo $active ?>"> <?php echo $row['eventName'] ?> </a><br/>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <?php
            if($event_ID!=0)
            {
        ?>
            <div class="mainContent" style="display:table-cell">
                <div class="mainInnerCon" style="margin-top:50px">
                    <?php
                        while($rowCont = mysqli_fetch_assoc($resCont)){    
                    ?>
                    <h3 style="margin-left:250px;margin-top:50px"> <?php echo $rowCont['contestName'] ?></h3>
                     <table class="overAll" style="margin-top: 10px; margin-left: 240px">
                        <thead>
                            <tr>
                                <th><p> Rank </p></th>
                                <th colspan="2"><p id="org"> Academic Org</p></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $rank = 0;
                                $total = 0;
                                $contestName = str_replace(' ', '', strtolower($rowCont['contestName']));
                                if($basis=='total')
                                {
                                    $querResult= "SELECT name, orgTotal 
                                                    FROM academicorg JOIN (SELECT acadOrg_ID, SUM($basis)/(SELECT COUNT(judge_ID) FROM judgeevent WHERE event_ID=$event_ID) AS orgTotal FROM $contestName GROUP BY acadOrg_ID) AS scores USING(acadOrg_ID) 
                                                            ORDER BY orgTotal $order";
                                }
                                else
                                {
                                     $querResult= "SELECT name, orgTotal 
                                                    FROM academicorg JOIN (SELECT acadOrg_ID, SUM($basis) AS orgTotal FROM $contestName GROUP BY acadOrg_ID) AS scores USING(acadOrg_ID) 
                                                            ORDER BY orgTotal $order";
                                }
                                $resResult = mysqli_query($dbconn, $querResult);
                                if(mysqli_affected_rows($dbconn)>0)
                                {
                                    while($rowResult = mysqli_fetch_assoc($resResult)){
                                        if($total !=  $rowResult['orgTotal'])
                                        {
                                            $rank++;
                                        }
                                        $total = $rowResult['orgTotal'];
                            ?>
                            <tr>
                                <td> <?php echo $rank ?></td>
                                <td> <img src="images/<?php echo $rowResult['name'] ?>.png" width="40px" alt="<?php echo $rowResult['name'] ?>" title="<?php echo $rowResult['name'] ?>"></td>
                                <td> <?php echo $rowResult['name'] ?></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </body>
</html>