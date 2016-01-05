<?php 
    session_start(); 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    $querRank = "SELECT name, overallTotal
                    FROM academicorg
                        ORDER BY overallTotal DESC";
    $resRank = mysqli_query($dbconn,$querRank);
    $rank = 0;
    $overallTotal = 0;

?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Overall Ranking </title>
        <link rel="stylesheet" type="text/css" href="css/overallTable.css">
         <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
         <link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li id="active"> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking </p></a></li>
                <li> <p id="space"></p></li>
                <li> <a href="contestResult.php?event_ID=0"> <p><i class="fa fa-trophy fa-2x"></i> Results </p></a></li>
                <li><a href="#"><p> <i class="fa fa-user fa-2x"></i> Login </p></a>
                    <ul>
                        <li> <a href="loginJudge.php"> Judge </a></li>
                        <li> <a href="loginSponsor.php"> Sponsor</a></li>
                        <li> <a href="loginAdmin.php"> Admin </a></li>
                    </ul>
                </li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
            <div class="backIcon">
                <a href="index.php"><i class="fa fa-arrow-circle-left fa-2x" title="Back"></i></a><br/>
            </div>
        </nav>
        
        <div class="table">
            <table class="overAll" style="margin-top: 150px; margin-left: 400px;">
                <thead>
                    <tr>
                        <th><p>Rank </p></th>
                        <th colspan=2> <p id="org">Academic Organization </p></th>
                        <th> <p>Points </p></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($rowRank = mysqli_fetch_assoc($resRank)){
                            if($overallTotal !=  $rowRank['overallTotal']){
                                $rank++;
                            }
                            $overallTotal = $rowRank['overallTotal'];
                    ?>
                    <tr>
                        <td> <?php echo $rank ?></td>
                        <td> <img  src="images/<?php echo $rowRank['name'] ?>.png" alt="<?php echo $rowRank['name'] ?>" title="<?php echo $rowRank['name'] ?>" width="40" height="40" ></td>
                        <td> <?php echo $rowRank['name'] ?> </td>
                        <td> <?php echo $rowRank['overallTotal']?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>