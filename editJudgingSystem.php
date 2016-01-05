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

    $message = '';

    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    if(isset($_POST['add']))        
    {
        $judgingSystem = $_POST['judgingSystem'];
        $query = "UPDATE contestevent SET judgingSystem=$judgingSystem WHERE event_ID=$event_ID";
        $result = mysqli_query($dbconn, $query);

        if(mysqli_affected_rows($dbconn)==1)
        {
            header("Location:sponsorPage.php?sponsor_ID=$sponsor_ID&event_ID=$event_ID");
        }
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Judging System</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
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
            <div class="backIcon">
                 <a href="sponsorPage.php?sponsor_ID=<?php echo $sponsor_ID?>&event_ID=<?php echo $event_ID?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
        
        <h2><?php echo $rowEventName['eventName'] ?> </h2>
        
        <form action="" method="post" class="formAdd">
            <label id="label"> Judging System </label> <br/>
            <label id="warning"> <?php echo $message ?> </label><br/>
            <p class="field" style="margin-left:70px">
                <input type="radio" name="judgingSystem" value='0' required/> Point
                <input type="radio" name="judgingSystem" value='1' required/> Rank
            </p>
            <p class="genSubmit">
                <button type="submit" name="add" id="genButton"> Add </button>
            </p>
        </form>
    </body>
</html>