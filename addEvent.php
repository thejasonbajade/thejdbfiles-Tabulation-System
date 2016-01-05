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

    $sponsor_ID = $_GET['sponsor_ID'];

    $message = '';
    $search = '';

    $querSponsorName = "SELECT sponsorName 
                            FROM sponsor 
                                WHERE sponsor_ID = $sponsor_ID";
    $resSponsorName = mysqli_query($dbconn, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName);

    if(isset($_POST['searchEvent']))
    {
        $search = $_POST['search'];
    }

    $querAddEvent = "SELECT event_ID, eventName, sponsor_ID
                        FROM (SELECT event_ID, eventName FROM contestevent WHERE eventName LIKE '%$search%') AS result 
                            LEFT JOIN (SELECT sponsor_ID, event_ID FROM eventsponsor WHERE sponsor_ID = $sponsor_ID) AS sponsors USING(event_ID)
                                ORDER BY eventName";
    $resAddEvent = mysqli_query($dbconn, $querAddEvent);
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Sponsor - Add Event </title>
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <?php
            
        ?>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home</p>  </a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking</p> </a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results</p></a> </li>
                <li id="active"> <a href="logoutAdmin.php"><p> <i class="fa fa-user fa-2x"></i> Admin Logout </p></a>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="viewSponsor.php?sponsor_ID=<?php echo $sponsor_ID ?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
                                           
        <div class="content" style="display: table; margin-top:150px">
            <div class="leftPanel">
                <div class="admin">
                    <a href="events.php"> Events </a><br/>
                    <a href="createEvent.php"> Create Event </a><br/>
                    <a href="sponsors.php">Sponsorsoring Organizations </a><br/>
                    <a href="createSponsor.php"> Register Sponsor </a>
                </div>
            </div>
            <div class="middlePanel">
                <div class="panelHeadAdmin">
                    <h2 id="panelTitle"> <?php echo  $rowSponsorName['sponsorName'] ?> </h2>  
                </div>
                <form action="#" method="post" class="formJudgeSearchAdmin">
                    <label id="label"> Search Events </label><br/>
                    <p class="field" style="margin-left:200px">
                        <i class="fa fa-search"></i>
                        <input type="search" name="search" placeholder="Type organzation name."> 
                    </p>
                        <button type="submit" name="searchEvent" id="leftButton"> Search </button><br/>                                             
                </form>
                <div class="searchResultAdmin">
                    <div class="result">
                        <table style="margin:0 auto">
                            <thead>
                               <tr>
                                    <th> Events </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                    
                                    while($rowAddEvent = mysqli_fetch_assoc($resAddEvent)){
                                ?>
                                <tr>
                                    <td style="width:350px"> <?php echo $rowAddEvent['eventName'] ?> </td>
                                <?php
                                    if($rowAddEvent['sponsor_ID']==NULL)
                                    {
                                ?>
                                    <td> <a href="addingEvent.php?event_ID=<?php echo $rowAddEvent['event_ID'] ?>&sponsor_ID=<?php echo $sponsor_ID ?>" id="add"> <i class="fa fa-plus-square" title="Add Judge"></i></a></td>    
                                <?php 
                                    }
                                ?>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>