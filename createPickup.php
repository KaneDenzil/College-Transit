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
  echo $bustime;
  $time = date("H:i", strtotime($bustime));
  echo $time;
  $source = $_POST['source'];
  $avail = $_POST['available'];

  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
  $sql =  "INSERT INTO pickup";
  $sql .= " (pick_time, pick_from, available_on_saturday)";
  $sql .= " VALUES (";
  $sql .= "'" . $time . "',";
  $sql .= "'" . $source . "',";
  $sql .= "'" . $avail . "'";
  $sql .=");";

  $result = mysqli_query($db, $sql);

  if ($result != null )
   {
    $new_id = mysqli_insert_id($db);
    header("Location: " . "admin_schedule.php");
    exit();
  }
  else {
    echo "INSERT failed. <br/>";
    echo "SQL command: " . $sql;

    // print out a the error
    echo "".mysqli_error($db);

   }

} 
?>
