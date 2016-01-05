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

    $contest_ID = $_GET['contest_ID'];
    $judge_ID = $_GET['judge_ID'];
    $acadOrg_ID = $_GET['acadOrg_ID'];
    $event_ID = $_GET['event_ID'];
    $sponsor_ID = $_GET['sponsor_ID'];

    $criIDs = array();
    $querCri = "SELECT criterion, cri_ID, percentage 
                    FROM criteria 
                        JOIN (SELECT cri_ID, percentage FROM criteriacon WHERE contest_ID=$contest_ID ) AS contestCri USING(cri_ID)"; 
    $resCri = mysqli_query($dbconn, $querCri);
    $numOfCri=0;

    $query = "SELECT contestName, main 
                FROM specificcontest 
                    WHERE contest_ID=$contest_ID";
    $result = mysqli_query($dbconn, $query);
    $row = mysqli_fetch_assoc($result);
    $contestName = str_replace(' ', '', strtolower($row['contestName']));
    $main = $row['main'];

    $querScore = "SELECT * 
                    FROM academicorg 
                        JOIN (SELECT * FROM $contestName WHERE judge_ID=$judge_ID AND acadOrg_ID = $acadOrg_ID) AS scores USING(acadOrg_ID)";
    $resScore = mysqli_query($dbconn, $querScore);
    $rowScore = mysqli_fetch_assoc($resScore); 

    if(isset($_POST['edit']))
    {
        $deduction = $_POST['deduction'];

        $query = "UPDATE $contestName 
                    SET total = 
                        CASE WHEN $deduction< deduction THEN total+(deduction-$deduction) 
                        ELSE total-($deduction-deduction) END, deduction=$deduction 
                            WHERE judge_ID=$judge_ID AND acadOrg_ID=$acadOrg_ID";     
        $result = mysqli_query($dbconn, $query);
        
        $rank = 0;
        $total = 0;
        $query = "SELECT total, acadOrg_ID 
                    FROM $contestName 
                        WHERE judge_ID=$judge_ID 
                            ORDER BY total DESC";
        $result = mysqli_query($dbconn, $query);
        while($row = mysqli_fetch_assoc($result))
        { 
            if($total !=  $row['total'])
            {
                $rank++;
            }
            $total = $row['total'];
            $acadOrg_ID = $row['acadOrg_ID'];
            $query1 = "UPDATE $contestName 
                        SET rank=$rank 
                            WHERE judge_ID=$judge_ID AND acadOrg_ID= $acadOrg_ID ";
            $result1 = mysqli_query($dbconn, $query1);
        }
     header("Location:viewScores.php?event_ID=$event_ID&contest_ID=$contest_ID&sponsor_ID=$sponsor_ID");
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Scores</title>
        <link rel="stylesheet" type="text/css" href="css/judgeTable.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li  id="active"><a href="logoutSponsor.php"><p> <i class="fa fa-user fa-2x"></i> Sponsor Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                  <a href="viewScores.php?event_ID=<?php echo $event_ID?>&contest_ID=<?php echo $contest_ID ?>&sponsor_ID=<?php echo $sponsor_ID?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
        
       
        <div class="scoresWrap">
             <h2 style="margin-left:100px"> <?php echo  $row['contestName'] ?> </h2>  
             <table style="margin-top:0px">
                    <thead class="head">
                        <tr>
                            <th> <p>Academic Org </p></th>
                            <?php 
                                while($rowCri = mysqli_fetch_assoc($resCri)){
                            ?>
                            <th> <p><?php echo $rowCri['criterion'] ?><br/> <?php echo $rowCri['percentage'].'%'  ?> </p></th>
                            <?php
                                    $criIDs[$numOfCri] = $rowCri['cri_ID'];
                                    $numOfCri++;
                                }
                            ?>
                            <th> <p id="total">Total</p></th>
                            <th> <p>Deductions</p></th>
                        </tr>
                    </thead>
                    <tbody class="scores">
                        <form action="#" method="post" id="form">
                        <tr>
                            <td id="OrgName"><?php echo $rowScore['name'] ?></td>
                            <?php
                                for($cri=0; $cri <  $numOfCri; $cri++){ 
                                    $criterion = 'criterion'.$criIDs[$cri];
                                    $name = $cri.'-'.$rowScore['acadOrg_ID'];
                            ?>
                            <td id="score"> <?php echo $rowScore[$criterion] ?> </td>
                            <?php
                                }
                            ?>
                            <td> <?php echo $rowScore['total'] ?></td>
                            <td> <input type="number" name="deduction" value="<?php echo $rowScore['deduction'] ?>" id="deduct" style="height:15px"/> </td>
                        </tr>
                        </form>
                    </tbody>
                </table>
                <p class="genSubmit" style="width:100px;margin:0 auto; margin-top:10px">
                    <button type='submit' name='edit' id="genButton" form="form"> Edit </button>
                </p>
        </div>
        
 </body>
</html>