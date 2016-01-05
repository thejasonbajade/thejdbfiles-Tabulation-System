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
    $sponsorName = '';
    $sponsorUsername = '';
    $sponsorPassword1 = '';
    $sponsorPassword2 = '';

    if(isset($_POST["addSponsor"]))
    {
        $sponsorName = $_POST['sponsorName'];
        $sponsorUsername = $_POST['sponsorUsername'];
        $sponsorPassword1 = $_POST['sponsorPassword1'];
        $sponsorPassword2 = $_POST['sponsorPassword2'];

        $query = "SELECT sponsor_ID FROM sponsor WHERE sponsorName = '$sponsorName'";
        $result = mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)>0)
        {
            $message = "Sponsoring organization already exists.";
        }
        else
        {
            $query = "SELECT sponsor_ID FROM sponsor WHERE username = '$sponsorUsername'";
            $result = mysqli_query($dbconn, $query);
            if(mysqli_affected_rows($dbconn)>0)
            {
                $message = "Username already exists.";
            }
            else
            {
                if($sponsorPassword1!=$sponsorPassword2)
                {
                    $message = "Password does not match.";
                }
                else
                {
                    $query = "INSERT INTO sponsor(sponsorName, username, password) 
                                VALUES('$sponsorName', '$sponsorUsername',md5('$sponsorPassword1'))"; 
                    $result = mysqli_query($dbconn, $query);
                    if(mysqli_affected_rows($dbconn)==1){
                        $message = 'Sponsoring org successfully added.';
                    }
                }
            }
        }
    }
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Register Sponsor </title>
       
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
         <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
    </head>
    <body>
        <nav class="navigate">
            <ul>
                <li> <a href="index.php"> <p><i class="fa fa-home fa-2x"></i> Home </p></a></li>
                <li> <a href="overallRanking.php"><p><i class="fa fa-th-list fa-2x"></i> Overall Ranking</p></a></li>
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
                    <a href="createEvent.php"> Create Event </a><br/>
                    <a href="sponsors.php">Sponsorsoring Organizations </a><br/>
                    <a href="createSponsor.php" id="activeTab"> Register Sponsor </a>
                </div>
            </div>
            <div class="middlePanel">
                <div class="panelHeadAdmin">
                    <h2 id="panelTitle"> Register Sponsor </h2>  
                </div>
                <form action="#" method="post" class="formAll" style="width:510px;padding-left:270px"><br/>
                    <label id="warning"> <?php echo $message ?> </label><br/>
                    <p class="field">
                        <i class="fa fa-users"></i>
                        <input type="text" name="sponsorName" placeholder="Organization Name" value="<?php echo $sponsorName ?>" required/><br/>
                    </p>
                    <p class="field">
                        <i class="fa fa-user"></i>
                        <input type="text" name="sponsorUsername" placeholder="Username" value="<?php echo $sponsorUsername ?>" required/><br/>
                    </p>
                    <p class="field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="sponsorPassword1" placeholder="Password" value="<?php echo $sponsorPassword1 ?>" required/><br/>
                    </p>
                    <p class="field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="sponsorPassword2" placeholder="Retype Password" value="<?php echo $sponsorPassword2 ?>" required/><br/>
                    </p>
                    <p class="genSubmit" style="margin-left:90px">
                        <button type="submit" name="addSponsor" id="genButton"> Add </button>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>