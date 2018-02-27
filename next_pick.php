
<?php include("header.php"); ?>

<?php require_once("db_functions.php") ?>

<?php
$db = connect();

?>
<?php 
$arr_pick=array();
$result_pick = get_pick_schedule();


if ($result_pick == FALSE)
 {
  echo "Database query failed. <br/>";
  exit();
}
 $strEnd   = new DateTime(date('H:i:s'));
 $current = $strEnd->format('H:i:s');

$query =  "SELECT * from pickup where pick_time >= '$current' ORDER BY pick_time LIMIT 1";

$res = mysqli_query($db, $query);

if ($res == null) {
  echo "Database query Failed.".$query;
}
else
{
	$next = mysqli_fetch_assoc($res);
	if($next != null)
	{
	$db_date = new DateTime($next['pick_time']);
    $time = $db_date->format('h:i A') ;
	echo "<br><br><br>";
	echo "<h1><center><b>";
	echo "Next PickUp bus is at ";
	echo " ".$time;
	echo " from ".$next['pick_from'];
	echo "<center></b></h1>";
	}
	else
	{
		echo "<br><br><br>";
		echo "<h1><center><b>Sorry! No Pickup Bus is available Today.<center></b></h1>";
	}
}
?>
 <?php include("footer.php"); ?>