<?php
    session_start(); 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    $sponsor_ID = $_GET['sponsor_ID'];
    
    $querSponsorName = "SELECT sponsorName 
                           FROM sponsor 
                                WHERE sponsor_ID = $sponsor_ID";
    $resSponsorName = mysqli_query($dbconn, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName);

    if(isset($_POST['proceed'])){
        $query = "DELETE FROM sponsor 
                    WHERE sponsor_ID=$sponsor_ID";
        $result = mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)==1)
        {
            header("Location:sponsors.php");
        }
    } 
?>
<html>
    <head>
        <title>Delete Sponsor</title>
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
                <a href="sponsors.php"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a>
            </div>
        </nav>
        <h2> <?php echo $rowSponsorName['sponsorName'] ?></h2>
        <form action="" method="post" class="formAdd">
            <label id="warning"> Are you sure you want to delete this Sponsor? </label><br/>
            <p class="genSubmit">
                <button type="submit" name="proceed" id="genButton"> Proceed </button>
            </p>
        </form>
    </body>
</html>