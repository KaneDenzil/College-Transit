<?php include("header.php"); ?>
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
	<div class="container">
    <div class="columns">
      <div class="column col-5 centered">
        <h1 class="text-center"> Add Pick Up Details<?php include("bar.php"); ?></h1>
      </div>
    </div>

	  <div class="columns">
		<div class="column col-2 col-mx-auto">
			
			 <form action="createPickup.php" method="POST" class="form-group text-center">

            <label class="form-label">Bus Time</label>
            <div class="input-group" style="width:45px;" >
              <input style="margin-left: 25px;" class="form-input" type="text" name="hour" placeholder="HH" pattern="^(0?[1-9]|1[012])$" title="Please insert hours between 1-12 ">
              <input class="form-input" type="text" name="minutes" placeholder="MM" pattern="^[0-5]?[0-9]$" title="Please insert minutes between 1 and 60 ">
              <div class="form-group" style="width:8px">
                <select class="form-select" name="format">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
              </div>
              </div>


            <label class="form-label" for="source">From Source</label>
            <select name="source" class="form-select">
            	<option value="Square One Missisauga">Missisauga</option>
  				    <option value="Charolais Blvd , near The Beer Store, Brampton">Brampton</option>
  			     </select>

            <label class="form-label" for="available">Available On Saturday?</label>
            <select name="available" class="form-select">
            	<option value="yes">Yes</option>
  				    <option value="no">No</option>
  			     </select>
            <p>
              <p></p>
              <input class="btn btn-primary" type="submit" value="Add" />
            </p>
		</div>
		</div>
	</div> <!-- // container -->
  
 <?php include("footer.php"); ?>