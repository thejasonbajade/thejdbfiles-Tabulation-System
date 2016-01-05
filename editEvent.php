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

    $querEventName = "SELECT eventName , date
                        FROM contestevent
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    if(isset($_POST['editEvent']))
    {
        $eventName = $_POST['eventName'];
        $date = $_POST['date'];

        $query = "UPDATE contestevent 
                    SET eventName = '$eventName', date = '$date' 
                        WHERE event_ID=$event_ID";
        $result = mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)==1)
        {
            header("Location:events.php");
        }
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title>Edit Event</title>
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
                <li id="active"><a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                  <a href="events.php?"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
        <h2><?php echo $rowEventName['eventName'] ?> </h2>
        <form action="" method="post" class="formAdd">
            <label id="label"> Edit Event </label><br/>
            <p class="field">
                <i class="fa fa-trophy"></i>
                <input type="text" name="eventName" value="<?php echo $rowEventName['eventName'] ?>"/><br/>
            </p>
            <p class="field">
                <i class="fa fa-calendar-plus-o"></i>
                <input type="date" name="date" value="<?php echo $rowEventName['date'] ?>" required/>
            </p>
            <p class="genSubmit">
                <button type="submit" name="editEvent" id="genButton"> Edit</button>
            </p>
        </form>
    </body>
</html>