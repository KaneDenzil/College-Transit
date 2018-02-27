<?php require_once("db_functions.php") ?>

<?php
// Starts the session
session_start();

// Checks if the user is logged in
if (isset($_SESSION['logged']) != TRUE )
{
 header("Location: " . "login.php");
 exit();
}
?>

<?php

$db = connect();

?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $bustime=$_POST['hour'].":".$_POST['minutes']." ".$_POST['format'];

  $time = date("H:i", strtotime($bustime));
  $des = $_POST['destination'];
  $avail = $_POST['available'];


  //$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  $sql =  "INSERT INTO departure";
  $sql .= " (departure_time, departure_to, available_on_saturday)";
  $sql .= " VALUES (";
  $sql .= "'" . $time . "',";
  $sql .= "'" . $des . "',";
  $sql .= "'" . $avail . "'";
  $sql .=");";

  $result = mysqli_query($db, $sql);

  if ($result == TRUE) {
    $new_id = mysqli_insert_id($db);
    header("Location: " . "admin_schedule.php");
    exit();
  }
  else {
    echo "INSERT failed. <br/>";
    echo "SQL command: " . $sql;

    // print out a the error
    echo mysqli_error($db);

    exit();
  }


} 
?>
