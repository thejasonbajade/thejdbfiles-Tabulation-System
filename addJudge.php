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
    $search = '';
    $judgeFirstName = '';
    $judgeLastName = '';
    $judgeUserName = '';
    $judgePassword1 = '';
    $judgePassword2 = '';

    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    if(isset($_POST["addJudge"]))
    {
        $judgeFirstName = $_POST["judgeFirstName"];
        $judgeLastName = $_POST["judgeLastName"];
        $judgeUserName = $_POST["judgeUserName"];
        $judgePassword1 = $_POST["judgePassword1"];
        $judgePassword2 = $_POST["judgePassword2"];

        $query = "SELECT judge_ID  
                    FROM judge WHERE username = '$judgeUserName'"; 
        $result = mysqli_query($dbconn, $query);
        if(mysqli_affected_rows($dbconn)==1)
        {
            $message = 'Username already used.';
        }
        else
        {
            if($judgePassword1 != $judgePassword2)
            {
                $message = 'Password does not match.';
            }
            else
            {
                $query = "INSERT INTO judge(firstName, lastName, username, password) VALUES('$judgeFirstName', '$judgeLastName', '$judgeUserName', md5('$judgePassword1'))"; 
                $result = mysqli_query($dbconn, $query);

                if(mysqli_affected_rows($dbconn)==1){
                     $message = 'Judge account successfully created.';
                }
            }
        }
    }
    if(isset($_POST['searchJudge']))
    {
        $search = $_POST['search'];
    }

    $querAddJudge = "SELECT judge_ID, name, event_ID 
                        FROM (SELECT judge_ID, CONCAT(firstName, ' ', lastName) AS name FROM judge WHERE (firstName LIKE '%$search%' OR lastName LIKE '%$search%') AND judge_ID != 0) as result 
                            LEFT JOIN (SELECT judge_ID, event_ID FROM judgeevent WHERE event_ID = $event_ID) AS judges USING(judge_ID)
                                ORDER BY name";
    $resAddJudge = mysqli_query($dbconn, $querAddJudge);
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Add Judge </title>
        <link rel="stylesheet" type="text/css" href="css/sponsorPage.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
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
                                           
        <h2 style="margin-left:180px"><?php echo $rowEventName['eventName'] ?> </h2>
                
        <div class="content" style="margin-top:0px"> 
            <div class="left">
                <div class="leftInner">
                    <form action="#" method="post" class="formJudgeSearch">
                        <label> Search Judge </label>
                        <p class="field" style="margin-left: 100px">
                            <i class="fa fa-search"></i>
                            <input type="search" name="search" placeholder="Type the first name or last name."> 
                        </p>
                        <button type="submit" name="searchJudge" id="leftButton"> Search </button>  
                    </form>
                    <div class="searchResult">
                        <div class="result">
                            <table style="margin:0 auto">
                                <thead>
                                   <tr>
                                        <th> Name of Judge </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($rowAddJudge = mysqli_fetch_assoc($resAddJudge)){
                                    ?>
                                    <tr>
                                        <td style="width:250px"> <?php echo $rowAddJudge['name'] ?> </td>
                                    <?php
                                        if($rowAddJudge['event_ID']==NULL)
                                        {
                                    ?>
                                        <td> <a href="addingJudge.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?>&judge_ID=<?php echo $rowAddJudge['judge_ID'] ?>" id="edit"> <i class="fa fa-plus-square" title="Add Judge"></i></a></td>    
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
            <div class="right">
                <form action="#" method="post" class="formAll">
                    <label id="label"> Judge </label><br/>
                    <label id="warning"> <?php echo $message ?></label><br/>
                    <p class="field">
                        <i class="fa fa-genderless"></i>
                        <input type="text" name="judgeFirstName" placeholder="First Name" value="<?php echo $judgeFirstName ?>" required/>
                    </p>
                    <p class="field">
                        <i class="fa fa-genderless"></i>
                        <input type="text" name="judgeLastName" placeholder="Last Name" value="<?php echo $judgeLastName ?>" required/>
                    </p>
                    <p class="field">
                        <i class="fa fa-user"></i>
                        <input type="text" name="judgeUserName" placeholder=" Username" value="<?php echo $judgeUserName ?>" required/>
                    </p>
                    <p class="field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="judgePassword1" placeholder="Password" value="<?php echo $judgePassword1 ?>" required/>
                    </p>
                    <p class="field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="judgePassword2" placeholder="Retype Password" value="<?php echo $judgePassword2 ?>" required/>  
                    </p>
                    <p class="genSubmit">
                        <button type="submit" name="addJudge" id="genButton"> Add </button>
                    </p>
                </form>
            </div>
            <div class="space">
            </div>
        </div>
    </body>
</html>