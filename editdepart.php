
<?php include("header.php"); ?>

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

 if (isset($_GET["pickid"]) == FALSE && isset($_GET["departid"]) == FALSE) 
  {
  // missing an id parameters, so   
    header("Location: " . "admin_schedule.php");
    exit();
  }

if(isset($_GET["pickid"]) == true)
 {
  $id=$_GET["pickid"];
  $table="pickup";
}

if(isset($_GET["departid"]) == true)
 {
  $id=$_GET["departid"]; 
  $table="departure";
 }

$sql =  "SELECT DATE_FORMAT(departure_time, '%H:%i') as departTime,departure_to,available_on_saturday from $table";
$sql .= " WHERE bus_id=". $id ;


$result = mysqli_query($db, $sql);

if ($result == FALSE) {
  echo "Database query failed. <br/>";
  echo "SQL command: " . $sql;
  exit();
}



// it's different! you only need to get 1 person, so no loop!
$detail = mysqli_fetch_assoc($result);
//print_r($person);
?>
	<div class="container">
	  <div class="columns">

    <div class="columns">
      <div class="column col-5 centered">

       <h1 class="text-center"> Edit Departure Details
      <?php include("bar.php"); ?></h1>
    </div>
  </div>

		<div class="column col-3 centered">
      <h1 class="text-center"> Update Departure Details</h1>
			<form action="" method="POST">
				<label class="form-label" for="busTime">Bus Time</label>
            <input class="form-input" type="text" name="busTime" value=
            <?php echo $detail['departTime']; ?> />


            <label class="form-label" for="destination"> To Destination</label>
            <select name="destination" class="form-select">
            	<option selected="selected" ><?php echo $detail['departure_to']; ?></option>
            	   <option value="Brampton">Brampton</option>
  				      <option value="Missisauga">Missisauga</option>
              	<option value="Missisauga/Brampton">Missisauga/Brampton</option>
  			   </select>

            <label class="form-label" for="available">Available On Saturday?</label>
            <select name="available" class="form-select">
            	<option selected="selected" ><?php echo $detail['available_on_saturday']; ?></option>
            	<option value="yes">Yes</option>
  				 <option value="no">No</option>
  			     </select>
            <p>
              <p></p>
              <input class="btn btn-primary" type="submit" value="Add" />
            </p>
			</form>
		</div>
	  </div>
	</div> <!-- // container -->


  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  $time = $_POST['busTime'];
  $location = $_POST['destination'];
  $avail= $_POST['available'];

   $query = "UPDATE departure SET  ";
  $query .= "departure_to='" . $location . "', ";
  $query .= "departure_time='" . $time . "', ";
  $query .= "available_on_saturday='" . $avail . "' ";
  $query .= "WHERE bus_id='" .$id. "' ";
  $query .= "LIMIT 1";

  $results = mysqli_query($db, $query);

  // for delete statements, the result is going to be true or false.
  if ($results == TRUE) {
    header("Location: " . "admin_schedule.php");
    exit();
  }
  if ($results == FALSE) {
    echo "Database query failed. <br/>";
    echo "SQL command: " . $query;
    exit();
  }
}
  ?>
 <?php include("footer.php"); ?>