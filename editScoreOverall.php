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
    $acadOrg_ID = $_GET['acadOrg_ID'];
    $event_ID = $_GET['event_ID'];
    $sponsor_ID = $_GET['sponsor_ID'];

    $query = "SELECT contestName,main 
                    FROM specificcontest 
                        WHERE contest_ID=$contest_ID";
    $result = mysqli_query($dbconn, $query);
    $row = mysqli_fetch_assoc($result);
    $contestName = str_replace(' ', '', strtolower($row['contestName']));
    $main = $row['main'];

    $querOverall = "SELECT SUM(total) as contestTotal, name 
                        FROM academicorg 
                            JOIN (SELECT total, acadOrg_ID FROM $contestName WHERE acadOrg_ID = $acadOrg_ID) AS orgScore USING(acadOrg_ID) GROUP BY acadOrg_ID";
    $resOverall = mysqli_query($dbconn, $querOverall);
    $rowOverall = mysqli_fetch_assoc($resOverall); 

    if(isset($_POST['deduct']))
    {
        $eventDeduction = $_POST['eventDeduction'];

        $query = "SELECT total FROM $contestName 
                    WHERE judge_ID = 0 AND acadOrg_ID = $acadOrg_ID";
        $result = mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)==0)
        {
            $query1 = "INSERT INTO $contestName(judge_ID, acadOrg_ID, total) 
                            VALUES(0, $acadOrg_ID, $eventDeduction*-1)";
            $result1 = mysqli_query($dbconn, $query1);
        }
        else
        {
            $query = "UPDATE $contestName 
                            SET total = $eventDeduction*-1
                                WHERE judge_ID=0 AND acadOrg_ID=$acadOrg_ID";
            $result = mysqli_query($dbconn, $query);
        }
        header("Location:viewScores.php?event_ID=$event_ID&contest_ID=$contest_ID&sponsor_ID=$sponsor_ID");
    }   
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
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li  id="active"><a href="logoutSponsor.php"><p> <i class="fa fa-user fa-2x"></i> Sponsor Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="viewScores.php?event_ID=<?php echo $event_ID ?>&contest_ID=<?php echo $contest_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a><br/>
            </div>
        </nav>
        
        <div class="scoresWrap">
             <h2 style="margin-Left:410px;"> <?php echo  $row['contestName'] ?> </h2>  
             <table style="margin-top:0px">
                <thead class="head">
                    <tr>
                        <th> <p>Academic Org </p></th>
                        <th> <p>Total</p></th>
                        <th> <p>Deductions</p></th>
                    </tr>
                </thead>
                <tbody class="scores">
                    <form action="#" method="post" id="form">
                    <tr>
                        <td> <?php echo $rowOverall['name'] ?></td>
                        <td> <?php echo $rowOverall['contestTotal'] ?></td>
                        <td> <input type="number" name="eventDeduction" id="deduct" style="width:100px"/> </td>
                    </tr>
                    </form>
                </tbody>
            </table>
            <p class="genSubmit" style="width:100px;margin:0 auto; margin-top:10px" >
                <button type="submit" name="deduct" id="genButton" form="form"> Deduct </button>
            </p>
        </div>
    </body>
</html>
    