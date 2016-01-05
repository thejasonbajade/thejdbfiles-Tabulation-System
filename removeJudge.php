<?php 
    session_start(); 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    $sponsor_ID = $_GET['sponsor_ID'];
    $event_ID = $_GET['event_ID'];
    $judge_ID = $_GET['judge_ID'];

    $query = "DELETE FROM judgeevent 
                WHERE event_ID=$event_ID AND judge_ID=$judge_ID";
    mysqli_query($dbconn, $query);

    if(mysqli_affected_rows($dbconn)==1)
    {
        header("Location:sponsorPage.php?sponsor_ID=$sponsor_ID&event_ID=$event_ID");
    }
?>