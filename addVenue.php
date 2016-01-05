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

    $querEventName = "SELECT eventName, venueName 
                        FROM venue JOIN (SELECT venue_ID, eventName FROM contestevent WHERE event_ID = $event_ID) as event USING(venue_ID)";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);



    $querVenue = "SELECT venueName 
                        FROM venue";
    $resVenue = mysqli_query($dbconn, $querVenue);

    if(isset($_POST['add']))        
    {
        $venueName = $_POST['venueName'];
        $query = "SELECT venue_ID 
                    FROM venue 
                        WHERE venueName='$venueName'";
        $result = mysqli_query($dbconn, $query);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_affected_rows($dbconn)==0)
        {
            $query = "INSERT INTO venue(venueName) VALUES('$venueName')";
            $result = mysqli_query($dbconn, $query);
            $query = "SELECT venue_ID 
                    FROM venue 
                        WHERE venueName='$venueName'";
            $result = mysqli_query($dbconn, $query);
            $row = mysqli_fetch_assoc($result);
            $venue_ID = $row['venue_ID'];

        } 
        $venue_ID = $row['venue_ID'];
        $query = "UPDATE contestevent 
                    SET venue_ID = $venue_ID 
                        WHERE event_ID=$event_ID";
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
        <title>Add Venue</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"><p><i class="fa fa-home fa-2x"></i> Home</p> </a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li id="active"><a href="logoutSponsor.php"><p><i class="fa fa-user fa-2x"></i> Sponsor Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="sponsorPage.php?sponsor_ID=<?php echo $sponsor_ID?>&event_ID=<?php echo $event_ID?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
      
        <h2> <?php echo $rowEventName['eventName'] ?> </h2>  
        <form action="" method="post" class="formAdd">
            <label id="label"> Add Venue </label> <br/>
            <label id="warning"> <?php echo $message ?> </label><br/>
            <p class="field">
                <i class="fa fa-university"></i>
                <input type="text" list="venues" name="venueName" value="<?php echo $rowEventName['venueName'] ?>" required/>
            </p>
            <p class="genSubmit">
                <button type="submit" name="add" id="genButton"> Add </button>
            </p>
            <datalist id="venues">
            <?php               
                while($rowVenue = mysqli_fetch_assoc($resVenue)){
            ?>    
                <option value="<?php echo $rowVenue['venueName']?>">  </option>
            <?php
                }
            ?>
            </datalist>
        </form>
    </body>
</html>