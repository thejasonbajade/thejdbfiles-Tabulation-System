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
    $contest_ID = $_GET['contest_ID'];

    $query = "SELECT contestName, main 
                FROM specificcontest 
                    WHERE contest_ID=$contest_ID";
    $result = mysqli_query($dbconn, $query);
    $row = mysqli_fetch_assoc($result);
    $contestName = str_replace(' ', '', strtolower($row['contestName']));  
    $main = $row['main'];

    $criIDs = array();

    $querJudge = "SELECT CONCAT(firstname, ' ', lastname) AS name, judge_ID 
                    FROM judge JOIN (SELECT judge_ID FROM judgeevent WHERE event_ID=$event_ID) AS judges USING(judge_ID)";
    $resJudge = mysqli_query($dbconn, $querJudge);

    $querjudgeSystem = "SELECT judgingSystem  
                            FROM contestevent WHERE event_ID=$event_ID";
    $resjudgeSystem = mysqli_query($dbconn, $querjudgeSystem);
    $rowjudgeSystem = mysqli_fetch_assoc($resjudgeSystem);
    $order = ($rowjudgeSystem['judgingSystem']==0?'DESC':($rowjudgeSystem['judgingSystem']==1?'ASC':''));

    if($rowjudgeSystem['judgingSystem'] == 0) //point
    {
         $querTabulated = "SELECT SUM(total) as contestTotal, acadOrg_ID , SUM(total)/(SELECT COUNT(judge_ID) FROM judgeevent WHERE event_ID=$event_ID) as rankBasis, name 
                                    FROM $contestName JOIN academicorg USING(acadOrg_ID) GROUP BY acadOrg_ID ORDER BY rankBasis $order";
        $basis = 'Total';
    }
    else if($rowjudgeSystem['judgingSystem'] == 1)
    {
        $querTabulated = "SELECT SUM(total) as contestTotal, SUM(rank) AS rankBasis, acadOrg_ID, name 
                    FROM $contestName JOIN academicorg USING(acadOrg_ID) JOIN joinevent USING(acadOrg_ID) 
                        WHERE event_ID=$event_ID GROUP BY acadOrg_ID ORDER BY rankBasis $order";
        $basis = 'Rank';
    }
     $resTabulated = mysqli_query($dbconn, $querTabulated);
     $resTabulated1 = mysqli_query($dbconn, $querTabulated);

?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Scores </title>
        <link rel="stylesheet" type="text/css" href="css/judgeTable.css">
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
                <li id="active"> <a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="viewEvent.php?event_ID=<?php echo $event_ID ?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a><br/>
            </div>
        </nav>
                             

        <?php
            while($rowJudge = mysqli_fetch_assoc($resJudge)){
                $judge_ID = $rowJudge['judge_ID'];
        ?>
            <div class="scoresWrap">
                <h2 style="margin-left:100px;margin-top:0px"><?php echo $rowJudge['name'] ?></h2>
                <table class="viewScores">
                    <thead class="head">
                        <tr>
                            <th> <p>Academic Org </p></th>
                            <?php
                                $numOfCri=0;
                                $querCri = "SELECT * FROM criteria 
                                                JOIN (SELECT cri_ID, percentage FROM criteriacon WHERE contest_ID=$contest_ID) AS cri USING(cri_ID)"; //get criteria each contest
                                $resCri = mysqli_query($dbconn, $querCri);
                                while($rowCri = mysqli_fetch_assoc($resCri)){
                            ?>
                            <th> <p><?php echo $rowCri['criterion'] ?> <br/> <?php echo $rowCri['percentage'].'%'  ?> </p></th>
                            <?php
                                    $criIDs[$numOfCri] = $rowCri['cri_ID'];
                                    $numOfCri++; 
                                } 
                            ?>
                            <th> <p id="total">Total</p></th>
                            <th> <p id="total">Deductions</p></th>
                            <th> <p id="rank">Rank</p></th>
                        </tr>
                    </thead>
                    <tbody class="scores">
                        <?php  
                            $querScores = "SELECT * 
                                                FROM (SELECT name, acadOrg_ID FROM academicorg) AS orgs
                                                    JOIN (SELECT * FROM $contestName WHERE judge_ID=$judge_ID) AS score USING(acadOrg_ID) 
                                                        JOIN (SELECT acadOrg_ID, orderNum FROM joinevent WHERE event_ID=$event_ID) AS conOrder USING(acadOrg_ID) 
                                                            ORDER BY orderNum";
                            $resScores = mysqli_query($dbconn, $querScores);
                            while($rowScores = mysqli_fetch_assoc($resScores)){ 
                        ?>
                        <tr>    
                            <td id="OrgName"><?php echo $rowScores['name'] ?></td>
                            <?php                                                 
                            for($counter=0; $counter<$numOfCri; $counter++){ 
                                $criterion = 'criterion'.$criIDs[$counter];
                            ?>
                            <td id="score"> <?php echo $rowScores[$criterion] ?> </td>
                            <?php
                                }   
                            ?>
                            <td id="score"> <?php echo $rowScores['total'] ?> </td>
                            <td id="score"> <?php echo $rowScores['deduction'] ?>  </td>
                            <td id="score"> <?php echo $rowScores['rank'] ?>  </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php 
                }
            ?>
            <h2 style="margin-left:400px;margin-top:50px;">Overall</h2>
            <table style="margin:0 auto">
                <thead class="head">
                    <tr>
                        <th> <p> Academic Org </p></th>
                        <th> <p> Deductions </p></th>
                        <th> <p> <?php echo $basis ?> </p></th>
                        <th> <p> Total Points </p></th>
                        <th> <p> Final Rank </p></th>
                    </tr>
                </thead>
                <tbody class="scores">
                    <?php
                        $rank = 0;
                        $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($resTabulated1)){
                            if($total !=  $rowTabulated['rankBasis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rankBasis'];
                    ?>
                    <tr>
                        <td> <?php echo $rowTabulated['name']?> </td>                         
                        <?php 
                            $acadOrg_ID = $rowTabulated['acadOrg_ID'];
                            $query2 = "SELECT total*-1 as total FROM $contestName WHERE acadOrg_ID=$acadOrg_ID AND judge_ID=0";
                            $result2 = mysqli_query($dbconn, $query2);
                            $row2 = mysqli_fetch_assoc($result2);
                            if(mysqli_affected_rows($dbconn)==1)
                            {        
                        ?>
                        <td><?php echo $row2['total']?> </td>
                        <?php        
                            }
                            else
                            {
                        ?>
                        <td> 0 </td>
                        <?php 
                            } 
                        ?>
                        <td><?php echo $rowTabulated['rankBasis']?> </td>
                        <td><?php echo $rowTabulated['contestTotal']?> </td>
                        <td><?php echo $rank ?> </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>   
    </body>
</html>