<?php 
    session_start(); 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'pahampang';
    $dbconn = mysqli_connect($host,$username,$password,$db) or die("Could not connect to database");
    mysqli_select_db($dbconn,$db);

    $event_ID = $_GET['event_ID'];
    $acadOrg_ID = $_GET['acadOrg_ID'];
    $sponsor_ID = $_GET['sponsor_ID'];

    $query = "INSERT INTO joinevent(acadOrg_ID, event_ID) 
                    VALUES($acadOrg_ID, $event_ID)";
    $result = mysqli_query($dbconn, $query);
    if(mysqli_affected_rows($dbconn)==1)
    {
        header("Location:manageContestant.php?event_ID=$event_ID&sponsor_ID=$sponsor_ID");
    }
?> 