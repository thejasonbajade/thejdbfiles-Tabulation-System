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

    $event_ID = $_GET['event_ID'];
    $sponsor_ID = $_GET['sponsor_ID'];
    $contest_ID = $_GET['contest_ID'];

    $message = '';

    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    $querConName = "SELECT contestName 
                        FROM specificcontest 
                            WHERE contest_ID = $contest_ID";
    $resConName = mysqli_query($dbconn, $querConName);
    $rowConName = mysqli_fetch_assoc($resConName);

    if(isset($_POST['addContest']))
    {
        $contestName = $_POST['contestName'];
        $main = $_POST['main'];
        $mainValue = ($main=='Yes'?1:0);
        
        $querMain = "SELECT main 
                        FROM specificcontest 
                            WHERE event_ID = $event_ID and main=1";
        $resMain = mysqli_query($dbconn, $querMain);
        $rowMain = mysqli_fetch_assoc($resMain);
        if(mysqli_affected_rows($dbconn)==1 && $mainValue==1)
        {
            $message="Main event already specified.";       
        }
        else
        {
            $query = "SELECT contestName 
                        FROM specificcontest 
                            WHERE contest_ID=$contest_ID";
            $result = mysqli_query($dbconn, $query);
            $row = mysqli_fetch_assoc($result);
            $contestNameOld = str_replace(' ', '', strtolower($row['contestName']));


            $query = "UPDATE specificcontest 
                        SET contestName = '$contestName', main = $mainValue 
                            WHERE contest_ID=$contest_ID";
            $result = mysqli_query($dbconn, $query);

            $contestName = str_replace(' ', '', strtolower($contestName));

            $query = "ALTER TABLE $contestNameOld 
                        RENAME TO $contestName";
            $result = mysqli_query($dbconn, $query);
            if(mysqli_affected_rows($dbconn)==0)
            {
                header("Location:sponsorPage.php?sponsor_ID=$sponsor_ID&event_ID=$event_ID");
            }
        }
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Edit Contest</title>
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
            <label id="label"> Edit Contest </label><br/>
            <label id="warning"> <?php echo $message ?> </label> <br/>
            <p class="field">
                <i class="fa fa-trophy"></i>
                <input type="text" name="contestName" value="<?php echo $rowConName['contestName'] ?>"/><br/>
            </p>
            <label> <b>Main event?</b> </label>
                <input type="radio" name="main" value="Yes" style="margin-left:30px"/>Yes
                <input type="radio" name="main" value="No"/>No
            <p class="genSubmit">
                <button type="submit" name="addContest" id="genButton"> Edit</button>
            </p>
        </form>
    </body>
</html>