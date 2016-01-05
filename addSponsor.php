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

    $message = '';
    $search = '';

    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    if(isset($_POST['searchSponsor']))
    {
        $search = $_POST['search'];
    }

    $querAddSponsor = "SELECT sponsor_ID, sponsorName, event_ID
                        FROM (SELECT sponsor_ID, sponsorName FROM sponsor WHERE sponsorName LIKE '%$search%') As result 
                            LEFT JOIN (SELECT sponsor_ID, event_ID FROM eventsponsor WHERE event_ID = $event_ID) AS sponsors USING(sponsor_ID)
                                ORDER BY sponsorName";
    $resAddSponsor = mysqli_query($dbconn, $querAddSponsor);
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Event - Add Sponsor </title>
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"><p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking</p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results</p></a></li>
                <li id="active"><a href="logoutAdmin.php"><p><i class="fa fa-user fa-2x"></i> Admin Logout </p></a>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                 <a href="viewEvent.php?event_ID=<?php echo $event_ID ?>"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>                                   
        
        <div class="content">
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
                    <h2 id="panelTitle"> <?php echo  $rowEventName['eventName'] ?> </h2>  
                </div>
                <form action="#" method="post" class="formJudgeSearchAdmin">
                    <label id="label"> Search Sponsoring Organization </label><br/>
                    <p class="field" style="margin-left:200px">
                        <i class="fa fa-search"></i>
                        <input type="search" name="search" placeholder="Type organzation name."> 
                    </p>
                    <button type="submit" name="searchSponsor" id="leftButton"> Search </button><br/>                                             
                </form>
                <div class="searchResultAdmin">
                    <div class="result">
                        <table style="margin:0 auto">
                            <thead>
                               <tr>
                                    <th> Sponsoring Organizations </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($rowAddSponsor = mysqli_fetch_assoc($resAddSponsor)){
                                ?>
                                <tr>
                                    <td style="width:350px"> <?php echo $rowAddSponsor['sponsorName'] ?> </td>
                                <?php
                                    if($rowAddSponsor['event_ID']==NULL)
                                    {
                                ?>
                                    <td> <a href="addingSponsor.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $rowAddSponsor['sponsor_ID'] ?>" id="add"> <i class="fa fa-plus-square" title="Add Judge"></i></a></td>    
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