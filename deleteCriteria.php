<?php 
    session_start(); 

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    $sponsor_ID = $_GET['sponsor_ID'];
    $contest_ID = $_GET['contest_ID'];
    $event_ID = $_GET['event_ID'];
    $cri_ID = $_GET['cri_ID'];

    $query = "DELETE FROM criteriacon 
                WHERE cri_ID=$cri_ID AND contest_ID=$contest_ID";
    $result = mysqli_query($dbconn, $query);
    if(mysqli_affected_rows($dbconn)==1)
    {
        $query1 = "SELECT contestName 
                        FROM specificcontest 
                            WHERE contest_ID=$contest_ID";
        $result1 = mysqli_query($dbconn, $query1);
        $row = mysqli_fetch_assoc($result1);
        $contestName = str_replace(' ', '', strtolower($row['contestName']));

        $columnName = 'criterion'.$cri_ID;
        $query1 = "ALTER TABLE $contestName 
                        DROP $columnName";
        $result1 = mysqli_query($dbconn, $query1);
        if(mysqli_affected_rows($dbconn)==0)
        {
            header("Location:sponsorPage.php?sponsor_ID=$sponsor_ID&event_ID=$event_ID");
        }
    }
?>