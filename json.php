<?php require_once("db_functions.php") ?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
?>
<?php
$db=connect();
// show an error message if PHP cannot connect to the database
if (!$db)
{
  $output = array("error" => "Failed to connect to MySQL: " . mysqli_connect_error());
  echo json_encode($output);
  exit();
}

// 2. make your database query
      $query = "SELECT * FROM pickup";

      $query2 = "SELECT * FROM departure";


      // 3. get the results
      $results1 = mysqli_query($db, $query);
      if ($results1 == FALSE) {
        $output = array("error" => "Database query failed. SQL command: " . $query);
        echo json_encode($output);
        exit();
      }

      $results2 = mysqli_query($db, $query2);
      if ($results2 == FALSE) {
        $output = array("error" => "Database quer failed. SQL command: " . $query2);
        echo json_encode($output);
        exit();
      }


        //  4. create a new associative array to store the results

        $arrivals=[];

  // 5. add each row item to the array
  while ($row = mysqli_fetch_assoc ($results1)) {

		$item=array(
			"id" => $row ["bus_id"],
			"pick_up_from" => $row ["pick_from"],
			"time" => $row ["pick_time"],
			"available_on_weekends" => $row ["available_on_saturday"],
		);
		array_push($arrivals, $item);
}




    $departures = [];

while ($row = mysqli_fetch_assoc ($results2)) {

    $item2=array(
      "id" => $row ["bus_id"],
      "departure_to" => $row ["departure_to"],
      "time" => $row ["departure_time"],
      "available_on_weekends" => $row ["available_on_saturday"],
    );
    array_push($departures, $item2);
}


// 6. output the results as json

  $output = array(
      "pick_up"=>$arrivals,
      "departures"=>$departures
  );
  if (isset($_GET["type"]) == TRUE )
  {
    if($_GET['type']=="pickup")
    {
    echo json_encode($arrivals);
    }
    else if($_GET['type']=="departures")
    {
    echo json_encode($departures);
    }
  }
  else
  {
	echo json_encode($output);
  }
?>