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

    $message = '';

    $querCategory = "SELECT name, weight_ID 
                            FROM weight";
    $resCategory = mysqli_query($dbconn, $querCategory);
    
    $eventName = '';
    $date = '';
    $weight = '';

    function generateEventCode()
    {
        $code = '';
        $count = 0;
        for($count = 0; $count<3; $count++)
        {
            $code = $code.chr(rand(65,90));
            $code = $code.chr(rand(48,57));
            $code = $code.chr(rand(97,122));
        }
        return $code;
    
    }

    if(isset($_POST["addEvent"]))
    {
        $eventName = $_POST["eventName"];
        $date = $_POST["date"];
        $weight = $_POST["weight"];
        $eventCode = generateEventCode();

        $query = "SELECT event_ID 
                    FROM contestevent 
                        WHERE eventName = '$eventName'";
        $result = mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)>0)
        {
            $message = 'Event already exists.';
        }
        else
        {
            $query = "INSERT INTO contestevent(eventName, eventCode, date, weight_ID) VALUES('$eventName', '$eventCode', '$date', $weight)"; 
            $result = mysqli_query($dbconn, $query);
            if(mysqli_affected_rows($dbconn)==1)
            {
                $message = 'Event successfully created.';
            }
        }
    }

    $querEvent = "SELECT event_ID, eventName 
                    FROM contestevent";
    $resEvent = mysqli_query($dbconn, $querEvent);
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Create Event </title>
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li id="active"> <a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a></li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                  <a href="adminPage.php"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
                                        
        <div class="content">
            <div class="leftPanel">
                <div class="admin">
                    <a href="events.php"> Events </a><br/>
                    <a href="createEvent.php" id="activeTab"> Create Event </a><br/>
                    <a href="sponsors.php">Sponsorsoring Organizations </a><br/>
                    <a href="createSponsor.php"> Register Sponsor </a>
                </div>
            </div>
            <div class="middlePanel">
                <div class="panelHeadAdmin">
                    <h2 id="panelTitle"> Create Event </h2>  
                </div>
                <form action="" method="post" class="formAll" style="width:510px;padding-left:270px"><br/>
                    <label id="warning"> <?php echo $message ?></label><br/>
                    <p class="field">
                        <i class="fa fa-trophy"></i>
                        <input type="text" name="eventName" placeholder="Event Name" value="<?php echo $eventName ?>" required/>
                    </p>
                    <p class="field">
                        <i class="fa fa-sliders"></i>
                        <select name="weight" value="<?php echo $weight ?>" required>
                            <?php
                                while($rowCategory = mysqli_fetch_assoc($resCategory))
                                {
                                    $weight_ID = $rowCategory['weight_ID'];
                            ?>

                            <option value="<?php echo $weight_ID ?>">  <?php echo $rowCategory['name']?></option>
                            <?php    
                                }
                            ?>
                        </select>
                    </p>
                    <p class="field">
                        <i class="fa fa-calendar-plus-o"></i>
                        <input type="date" name="date" value="<?php echo $date ?>" required/>
                    </p>
                    <p class="genSubmit" style="margin-left:90px">
                        <button type="submit" name="addEvent" id="genButton"> Add Event</button>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>