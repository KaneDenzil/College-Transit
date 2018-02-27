<?php
require_once("db_credentials.php");
date_default_timezone_set('America/Toronto');
$db=connect();

function connect() {
	$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}
	return $connection;
}

function disconnect($connection) {
	if (isset($connection)) {
		mysqli_close($connection);
	}
}

function get_user() {
	global $db;
	$sql = "SELECT * FROM admin";

	$results = mysqli_query($db, $sql);
	
	if ($results == FALSE) {
	  echo "Database query failed. <br/>";
	  echo "SQL command: " . $sql;
	  exit();
	}
	
	return $results;
}

function get_pick_schedule() {
	global $db;
	$sql = "SELECT * FROM pickup ORDER BY pick_time";

	$results = mysqli_query($db, $sql);
	
	if ($results == FALSE) {
	  echo "Database query failed. <br/>";
	  echo "SQL command: " . $sql;
	  exit();
	}
	
	return $results;
}

function get_depart_schedule() {
	global $db;
	$sql = "SELECT * FROM departure ORDER BY departure_time";

	$results = mysqli_query($db, $sql);
	
	if ($results == FALSE) {
	  echo "Database query failed. <br/>";
	  echo "SQL command: " . $sql;
	  exit();
	}
	
	return $results;
}

function delete_departure($id) {
	global $db;

	echo "Doing the sql now: " .$id . " <br>";
	$query = "DELETE FROM departure ";
    $query .= "WHERE bus_id=".$id;

    echo " Finished deleting <br>";


	$results = mysqli_query($db, $query);

	print_r($results);	
	//echo $results;
	if ($results == FALSE) {
	  	echo "Database query failed. <br/>".$query;
	 	echo "SQL command: " . $query;
	}
	else
	{
	header("Location: " . "admin_schedule.php");
   	exit();
	}
}

function delete_pickup($id) {
	global $db;
	echo "Doing the sql now: " .$id . " <br>";
	$query = "DELETE FROM pickup ";
    $query .= "WHERE bus_id=". $id;

	$results = mysqli_query($db, $query);
	
	if ($results == FALSE) {
	  echo "Database query failed. <br/>";
	  echo "SQL command: " . $query;
	  exit();
	}
	else
	{
		header("Location: " . "admin_schedule.php");
    	exit();
	}
}


function get_buspass_info($studentid) {
	global $db;
	$query = "SELECT * FROM student ";
	$query .= "where Student_ID =  '" . $studentid . "'";

	$query .= "LIMIT 1";
	$results = mysqli_query($db, $query);

	if ($results == FALSE) {
	  echo "Database query failed. <br/>";
	  echo "SQL command: " . $sql;
	  exit();
	}

	return $results;
}
?>