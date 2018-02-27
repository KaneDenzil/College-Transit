<?php include("header.php"); ?>

<?php require_once("db_functions.php") ?>

<?php
$db = connect();

?>
<?php

$strEnd   = new DateTime(date('H:i:s'));
 $current = $strEnd->format('H:i:s');


$query =  "SELECT * from departure where departure_time > '$current' ORDER BY departure_time LIMIT 1 ";
$res = mysqli_query($db, $query);
if ($res == null) {
  echo "Database query Failed.".$query;
}
else
{
  $next = mysqli_fetch_assoc($res);
  if($next != null)
  {
  $db_date = new DateTime($next['departure_time']);
  $time = $db_date->format('h:i A') ;
  $message = "Next Departure bus is at ".$time." to ".$next['departure_to'];
  echo "<br><br><br>";
  echo "<h1><center><b>".$message."<center></b></h1>";
  exit();
  }
  else
  {
    echo "<br><br><br>";
    echo "<h1><center><b>Sorry! No Departure Bus is Available Today.<center></b></h1>";
  }
}

?>