<?php 
    session_start(); 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    if(isset($_SESSION['admin_ID']))
    {
         header("Location:adminPage.php");
    }

    $message = '';
    $username = '';
    $password = '';

    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT admin_ID 
                    FROM admin 
                        WHERE username='$username' AND password=md5('$password')";
        $result = mysqli_query($dbconn, $query);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_affected_rows($dbconn)==1)
        {
            $_SESSION["admin_ID"] = $row['admin_ID'];
            header("Location:adminPage.php");
            echo "hahaha";
        } 
        else
        {
            $message = "Please enter the correct username/password.";
        }
    }
?> 
<!DOCTYPE html>  
<html>
    <head>
        <title> Admin Login </title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
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
                <li id="active"><a href="#"><p> <i class="fa fa-user fa-2x"></i> Login </p></a>
                    <ul>
                        <li> <a href="loginJudge.php"> Judge </a></li>
                        <li> <a href="loginSponsor.php"> Sponsor</a></li>
                        <li> <a href="loginAdmin.php"> Admin </a></li>
                    </ul>
                </li>
            </ul>
            <img src="images/uscLogo.png" alt="University Student Council Logo" title="University Student Council Logo" class="logo">
        </nav>
        
        <form class="form" action="#" method="post">
            <label id="label"> Admin </label><br/>
            <label id="warning"> <?php echo $message ?> </label><br/>
            <p class="field">
                <i class="fa fa-user"></i>
                <input type="text" name="username" placeholder="Username" value="<?php echo $username ?>" required/>
            </p>
            <p class="field">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Password" value="<?php echo $password ?>" required/>
            </p>
            <p class="submit">
                <button type="submit" name="login"><i class="fa fa-sign-in"></i> </button><br/>  
            </p>
        </form> 
    </body>
</html>
