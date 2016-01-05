<?php 
    session_start();
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    $event_ID = $_GET['event_ID'];
    $sponsor_ID = $_GET['sponsor_ID'];

    $message = '';
    
    $querEventName = "SELECT eventName 
                        FROM contestevent 
                            WHERE event_ID = $event_ID";
    $resEventName = mysqli_query($dbconn, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    $querOrg = "SELECT acadOrg_ID, name, event_ID 
                    FROM (SELECT acadOrg_ID, name FROM academicorg) as result 
                        LEFT JOIN (SELECT acadOrg_ID, event_ID FROM joinevent WHERE event_ID = $event_ID) AS judges USING(acadOrg_ID)
                            ORDER BY name";
    $resOrg = mysqli_query($dbconn, $querOrg);

    
    if(isset($_POST['order']))
    {
        $orderArray = array();
        $count = 0;
        
        $querOrgID = "SELECT acadOrg_ID FROM joinevent JOIN academicorg USING(acadOrg_ID) WHERE event_ID = $event_ID";
        $result = mysqli_query($dbconn, $querOrgID);
        while($row = mysqli_fetch_assoc($result))
        { 
            $acadOrg_ID = $row['acadOrg_ID'];
            $orderNum = $_POST[$acadOrg_ID];
            $orderArray[$count] = $orderNum;
            $count++;
        }
        sort($orderArray);
        $arrLength = count($orderArray);
        for($count=0; $count<$arrLength; $count++)
        {
            if($orderArray[$count] != $count+1){
                $message = 'Please check your input. The numbers must be distinct';
                break;
            } 
        }
        if($count==$arrLength)
        {
            $result = mysqli_query($dbconn, $querOrgID);
            while($row = mysqli_fetch_assoc($result)) 
            {   
                $acadOrg_ID = $row['acadOrg_ID'];
                $orderNum = $_POST[$acadOrg_ID];
                $querUpdate = "UPDATE joinevent SET orderNum = $orderNum WHERE event_ID=$event_ID AND acadOrg_ID = $acadOrg_ID";
                $resUpdate = mysqli_query($dbconn, $querUpdate);
            }
            $message = 'Contestants successfully ordered.';
        }
    }

    $querOrder = "SELECT acadOrg_ID, name, orderNum 
                    FROM academicorg 
                        JOIN (SELECT acadOrg_ID, orderNum FROM joinevent WHERE event_ID = $event_ID) AS orgOrderS USING(acadOrg_ID)";
    $resOrder = mysqli_query($dbconn, $querOrder);
?> 
<!DOCTYPE html> 
<html>
    <head>
        <title> Manage Academic Org </title>
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
                                           
        <h2 style="margin-left:180px"> <?php echo $rowEventName['eventName'] ?> </h2>
        
        <div class="content" class="content" style="margin-top:0px"> 
            <div class="left">
                <div class="leftInner">
                    <div class="searchResult">
                        <div class="result">
                            <table>
                                <thead>
                                   <tr>
                                        <th> Academimic Organizations </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($rowOrg = mysqli_fetch_assoc($resOrg)){
                                    ?>
                                    <tr>
                                        <td> <?php echo $rowOrg['name'] ?> </td>
                                    <?php
                                        if($rowOrg['event_ID']==NULL)
                                        {
                                    ?>
                                        <td> <a href="addingContestant.php?event_ID=<?php echo $event_ID ?>&sponsor_ID=<?php echo $sponsor_ID ?>&acadOrg_ID=<?php echo $rowOrg['acadOrg_ID'] ?>" id="add"> <i class="fa fa-plus-square" title="Add Judge"></i></a></td>    
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
                <form method="post" action="#" id="form" class="formAll" >
                    <label id="label"> Order </label><br/>
                    <label id="warning"> <?php echo $message ?> </label><br/>
                    <table style="margin-left:25px; font-size:16px">
                        <tbody>
                        <?php
                            while($rowOrder = mysqli_fetch_assoc($resOrder)){ 
                        ?>
                            <tr>
                                <td><?php echo $rowOrder['name']?></td>
                                <td style="padding:5px"> 
                                    <input type=number name="<?php echo $rowOrder['acadOrg_ID'] ?>" value="<?php echo $rowOrder['orderNum']?>" style="width:100px;margin-bottom:-10px;" required/>
                                </td>
                            </tr>
                        <?php 
                            } 
                        ?>
                        </tbody>
                    </table>
                    <p class="genSubmit">
                        <button type="submit" name="order" id="genButton"> Order </button>
                    </p>
                </form>    
            </div>
            <div class="space">
            </div>
        </div>
    </body>
</html>