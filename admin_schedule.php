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
$result_pick = get_pick_schedule();
$result_depart = get_depart_schedule();

?>


<div class="container">
      <div class = "columns">
        <div class="column col-10 col-mx-auto">

          <a href="pickup.php" class="btn"> Create New PickUp </a>

          <?php include("bar.php"); ?>
          <table class="table">
            <tr>
              <th>Bus Time</th>
              <th>PickUp Location</th>
              <th>Available On Saturday ?</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>

            <?php while ($bus_pick = mysqli_fetch_assoc($result_pick)) { ?>
              <tr>
                <td><?php 
                	$date = new DateTime($bus_pick['pick_time']);
    				      echo $date->format('h:i A') ;
                ?></td>
                <td><?php echo $bus_pick['pick_from']; ?></td>
                <td><?php echo $bus_pick['available_on_saturday']; ?></td>
                <td><a class="btn" href="<?php echo 'editpickup.php?pickid=' . $bus_pick['bus_id']; ?>">Edit</a></td>
               <td> <a class="btn" href="<?php echo 'delete.php?pickid=' . $bus_pick['bus_id'] ?>">Delete</button> </td>
              </tr>
            <?php } ?>

          </table>


        </div> <!--// col-12 -->
      </div> <!-- // column -->

      <br>
      <br>
      <div class = "columns">
        <div class="column col-10 col-mx-auto">

          <a href="departure.php" class="btn"> Create New Departure </a>
          <table class="table">
            <tr>
              <th>Bus Time</th>
              <th>Departure To Location</th>
              <th>Available On Saturday ?</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>

            <?php while ($bus_depart = mysqli_fetch_assoc($result_depart)) { ?>
              <tr>
                <td><?php 
                	$date = new DateTime($bus_depart['departure_time']);
    				      echo $date->format('h:i A') ;
                ?></td>
                <td><?php echo $bus_depart['departure_to']; ?></td>
                <td><?php echo $bus_depart['available_on_saturday']; ?></td>
                <td><a class="btn" href="<?php echo 'editdepart.php?departid=' . $bus_depart['bus_id']; ?>">Edit</a></td>
                <td><a class="btn" href="<?php echo 'delete.php?departid=' . $bus_pick['bus_id'] ?>">Delete</button>
                		
                </td>
              </tr>
              
            <?php } ?>

          </table>


        </div> <!--// col-12 -->
      </div> <!-- // column -->


    </div> <!--// container -->

<?php include("footer.php"); ?>