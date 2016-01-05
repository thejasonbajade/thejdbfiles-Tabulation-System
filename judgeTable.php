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

    $event_ID = $_GET['event_ID'];
    $contest_ID = $_GET['contest_ID'];
    $judge_ID = $_GET['judge_ID'];

    $status = 'allowed';
    
    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    $query = "SELECT contestName, main 
                FROM specificcontest 
                    WHERE contest_ID=$contest_ID";
    $result = mysqli_query($dbconn, $query);
    $row = mysqli_fetch_assoc($result);
    $contestName = str_replace(' ', '', strtolower($row['contestName']));  
    $main = $row['main'];

    $querContest = "SELECT contestName, contest_ID 
                        FROM specificcontest 
                            WHERE event_ID=$event_ID";
    $resContest = mysqli_query($dbconn, $querContest);

    $querScores = "SELECT acadOrg_ID, name 
                    FROM academicorg JOIN (SELECT acadOrg_ID, orderNum FROM joinevent WHERE event_ID = $event_ID) AS contestants USING(acadOrg_ID) 
                        ORDER BY orderNum";
    $resScores = mysqli_query($dbconn, $querScores);

    $query1 = "SELECT judge_ID 
                FROM $contestName 
                    WHERE judge_ID=$judge_ID";
    $result1 = mysqli_query($dbconn, $query1);

    if(mysqli_affected_rows($dbconn)!=0) 
    {
        $status = 'notAllowed';
    }

    if(isset($_POST['submitScores']))
    {

        $querOrg = "SELECT acadOrg_ID 
                    FROM joinevent 
                        WHERE event_ID = $event_ID";
        $resOrg = mysqli_query($dbconn, $querOrg);
        while($rowOrg = mysqli_fetch_assoc($resOrg))
        {
            $total = 0;
            $acadOrg_ID = $rowOrg['acadOrg_ID'];
            $query1 = "INSERT INTO $contestName(judge_ID, acadOrg_ID) 
                        VALUES($judge_ID, $acadOrg_ID )";
            $result1 = mysqli_query($dbconn, $query1);

            $querCri = "SELECT cri_ID 
                        FROM criteriacon 
                            WHERE contest_ID=$contest_ID";
            $resCri = mysqli_query($dbconn, $querCri);
            $cri=0;
            while($rowCri = mysqli_fetch_assoc($resCri))
            {
                $name = $cri.'-'.$acadOrg_ID;
                $indScores = $_POST["$name"];
                $criterion = "criterion".$rowCri['cri_ID']; 
                $query2 = "UPDATE $contestName 
                            SET $criterion = $indScores 
                                WHERE judge_ID=$judge_ID AND acadOrg_ID= $acadOrg_ID ";
                $result2 = mysqli_query($dbconn, $query2);
                $total += $indScores;
                $cri++;
            }
            $query1 = "UPDATE $contestName 
                        SET total=$total 
                            WHERE judge_ID=$judge_ID AND acadOrg_ID=$acadOrg_ID";
            $result1 = mysqli_query($dbconn, $query1);
        }   


        $query="SELECT acadOrg_ID, total FROM $contestName WHERE judge_ID=$judge_ID ORDER BY total DESC";
        $result = mysqli_query($dbconn, $query);
        $rank = 0;
        $total = 0;
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

        header("Location:judgePage.php?judge_ID=$judge_ID");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Judge</title>
        
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
                <li  id="active"><a href="logoutJudge.php"><p> <i class="fa fa-user fa-2x"></i> Judge Logout </p></a> </li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                <a href="judgePage.php?judge_ID=<?php echo $judge_ID ?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
        <br/>
        <div class="tableNav">
            <div class="innerTableNav">
                <ul>
                    <?php 
                        while($rowContest = mysqli_fetch_assoc($resContest)){
                            $active = (($contest_ID == $rowContest['contest_ID'])?"active":"");
                    ?>
                    <li id="<?php echo $active ?>"> <a href="judgeTable.php?judge_ID=<?php echo $judge_ID?>&event_ID=<?php echo $event_ID ?>&contest_ID=<?php echo $rowContest['contest_ID'] ?>" target="_blank"> <?php echo $rowContest['contestName'] ?></a> </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <?php 
            if($status== 'notAllowed'){
        ?>
        <h2 style="margin-left:400px"> You're no longer allowed to access this page. </h2>
    
        <?php 
            } 
            else
            {
        ?>
            <div class="wrapper">
                <table>
                    <thead class="head">
                        <tr>
                            <th> <p>Academic Org </p></th>
                            <?php 
                                $query = "SELECT criterion, percentage 
                                            FROM criteria JOIN (SELECT cri_ID, percentage FROM criteriacon WHERE contest_ID=$contest_ID) AS cri USING(cri_ID)"; //get criteria each contest
                                $result = mysqli_query($dbconn, $query);
                                $percentage = array();
                                $numOfCri=0;
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <th> <p><?php echo $row['criterion'] ?><br/> <?php echo $row['percentage'] ?>% </p></th>
                            <?php
                                    $percentage[$numOfCri] = $row['percentage'];
                                    $numOfCri++;
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="scores">
                        <form action="#" method="post" id="forms">
                            <?php  
                                while($rowScores = mysqli_fetch_assoc($resScores)){ 
                            ?>
                            <tr>
                                <td> <?php echo $rowScores['name'] ?></td>
                                <?php 
                                    for($rowNumber = 0; $rowNumber < $numOfCri; $rowNumber++){ 
                                    $name = $rowNumber.'-'.$rowScores['acadOrg_ID'];
                                ?>
                                <td> <input type="number" name="<?php echo $name ?>" min="0" max="<?php echo $percentage[$rowNumber]?>" required/> </td>
                                <?php
                                    }
                                ?>
                            </tr>
                            <?php
                                }
                            ?>
                        </form>
                    </tbody>
                </table>
            </div>
            <br/>
            <p style="margin-left:400px"> <b style="color:red">NOTE:</b> You are no longer allowed to edit the scores after submission.</p>
            <p class="genSubmit" style="margin: 0 auto;margin-top:5px;">
                <button type="submit" name="submitScores" id="genButton" form="forms"> Submit Scores </button>
            </p>
        <?php
            }
        ?>  
    </body>
</html>