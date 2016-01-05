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
    $sponsor_ID = $_GET['sponsor_ID'];
    $event_ID = $_GET['event_ID'];
    $cri_ID = $_GET['cri_ID'];

    $message='';

    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    $querCriteria = "SELECT criterion, percentage 
                        FROM criteria JOIN (SELECT cri_ID, percentage FROM criteriacon WHERE contest_ID=$contest_ID AND cri_ID=$cri_ID) AS criPercentage USING(cri_ID)"; 
    $resCriteria = mysqli_query($dbconn, $querCriteria);
    $rowCriteria = mysqli_fetch_assoc($resCriteria);

    $querAllCri = "SELECT criterion FROM criteria";
    $resAllCri = mysqli_query($dbconn, $querAllCri);

    $querPercentTotal = "SELECT 100-SUM(percentage) as maxPercent
                            FROM criteriacon WHERE contest_ID=$contest_ID";
    $resPercentTotal = mysqli_query($dbconn, $querPercentTotal);
    $rowPercentTotal = mysqli_fetch_assoc($resPercentTotal);
    $maxPercent = ($rowPercentTotal['maxPercent']==NULL?100:$rowPercentTotal['maxPercent']);
    
    if(isset($_POST['edit']))
    {
        $criterion = $_POST['criterion'];
        $percentage = $_POST['percentage'];

        $query = "SELECT cri_ID 
                    FROM criteria 
                        WHERE criterion='$criterion'";
        $result = mysqli_query($dbconn, $query);
        $row = mysqli_fetch_assoc($result);

        if(mysqli_affected_rows($dbconn)==0)
        {
            $query = "INSERT INTO criteria(criterion) 
                        VALUES('$criterion')";
            $result = mysqli_query($dbconn, $query);
            $query = "SELECT cri_ID 
                        FROM criteria 
                            WHERE criterion='$criterion'";
            $result = mysqli_query($dbconn, $query);
            $row = mysqli_fetch_assoc($result);

        } 
        $cri_IDNew = $row['cri_ID'];
        $query = "UPDATE criteriacon 
                    SET cri_ID = $cri_IDNew, percentage=$percentage 
                        WHERE cri_ID=$cri_ID AND contest_ID=$contest_ID";
        $result = mysqli_query($dbconn, $query);

        $query = "SELECT contestName 
                    FROM specificcontest 
                        WHERE contest_ID=$contest_ID";
        $result = mysqli_query($dbconn, $query);
        $row = mysqli_fetch_assoc($result);
        $contestName = str_replace(' ', '', strtolower($row['contestName']));


        $columnName = 'criterion'.$cri_ID;
        $columnNameNew = 'criterion'.$cri_IDNew;
        $query = "ALTER TABLE $contestName 
                     CHANGE $columnName $columnNameNew INT(11) NOT NULL DEFAULT '0'";
        $result = mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)==0)
        {
            header("Location:sponsorPage.php?sponsor_ID=$sponsor_ID&event_ID=$event_ID");
        }
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Edit Criteria</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
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
                <a href="sponsorPage.php?sponsor_ID=<?php echo $sponsor_ID?>&event_ID=<?php echo $event_ID?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
        
        <h2><?php echo $rowEventName['eventName'] ?> </h2>
         
        <form action="" method="post" class="formAdd">
            <label id="label"> Edit Criteria </label><br/>
            <label id="warning"> <?php echo $message ?> </label><br/>
            <p class="field">
                <i class="fa fa-tasks"></i>
                <input type="text" list="criteria" name="criterion" value="<?php echo $rowCriteria['criterion']?>" required/>
            </p>
            <p class="field">
                <i class="fa fa-info"></i>
                <input type="number" name="percentage" value="<?php echo $rowCriteria['percentage']?>" max="<?php echo $maxPercent+$rowCriteria['percentage'] ?>" required/>
            </p>
            <p class="genSubmit">
                <button type="submit" name="edit" id="genButton"> Edit </button>
            </p>
            <datalist id="criteria">
            <?php 
                while($rowAllCri = mysqli_fetch_assoc($resAllCri)){ 
            ?>
            <option value=""> <?php echo $rowAllCri['criterion'] ?></option>
            <?php
                }
            ?>
            </datalist>
        </form>
    </body>
</html>