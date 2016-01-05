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
    $event_ID = $_GET['event_ID'];
    $message = '';
    $eventCode = '';

    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    if(isset($_POST['enterEvent']))
    {
        $eventCode = $_POST['eventCode'];
        $query = "SELECT eventCode
                    FROM contestevent  
                        WHERE event_ID=$event_ID AND eventCode='$eventCode'";

        $result= mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)==1)
        {
            $query = "SELECT contest_ID 
                        FROM specificcontest  
                            WHERE event_ID=$event_ID LIMIT 1";

            $result= mysqli_query($dbconn, $query);
            $row = mysqli_fetch_assoc($result); 
            $contest_ID = $row['contest_ID'];
            header("Location:judgeTable.php?judge_ID=$judge_ID&event_ID=$event_ID&contest_ID=$contest_ID");
        } 
        else
        {
            $message="Enter the correct event code";
        }
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Judge</title>
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
                <li  id="active"><a href="logoutJudge.php"><p> <i class="fa fa-user fa-2x"></i> Judge Logout </p></a> </li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                <a href="judgePage.php?judge_ID=<?php echo $judge_ID?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
        
        <h2><?php echo $rowEventName['eventName'] ?> </h2>
        
        <form action="#" method="post" class="formAdd">
            <label id="label"> Event Code</label><br/>
            <label id="warning"> <?php echo $message ?> </label><br/>
            <p class="field">
                <i class="fa fa-lock"></i>
                <input type="password" name="eventCode" placeholder="Event Code" value="<?php echo $eventCode ?>" required/><br/>
            </p>
            <p class="genSubmit">
                <button type="submit" name="enterEvent" id="genButton"> Proceed </button>
            </p>
        </form>
    </body>
</html>