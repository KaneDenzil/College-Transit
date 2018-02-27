<?php include("header.php"); ?>
<?php require_once("db_functions.php") ?>

<?php

$db = connect();
$result_pick = get_pick_schedule();
$result_depart = get_depart_schedule();

?>
<div class="container">
		<div class="columns"><div class="column col-10">
			<a href="brampton.html" style="float:right;">Brampton Pick up Location</a><br>
			<a href="mississauga.html" style="float:right;"> Missisauga Pick up Location</a>
		</div>
		</div>
	</div>

	<div class="container">
		<div class="columns">

			<div class="column col-10 centered">
		<h1 style="color:#000080;text-align: center;"><u><b>Bus Service Run From Monday To Saturday</b></u></h1>
			</div>
		</div>

	  <div class="columns">

		<div class="column col-6 centered">
			<h1><b><u> Pick Up Times/Locations</u></b></h1>
			<?php
				while ($pick_buses = mysqli_fetch_assoc($result_pick)) {
					if($pick_buses["available_on_saturday"] == "no")
					{
						?>
							<li style="background-color:yellow" type="square">
						<?php 
							$date = new DateTime($pick_buses["pick_time"]);
    						echo $date->format('h:i A') ;
						?> , Pick Up From 
					<b><?php echo $pick_buses["pick_from"]; ?> </b>
				</li>
					<?php
					}
						else
						{
					?>
					<li type="square">
					<?php 
							$date = new DateTime($pick_buses["pick_time"]);
    						echo $date->format('h:i A') ;
					?> , Pick Up From 
					<b><?php echo $pick_buses["pick_from"]; ?> </b>
				</li>
				<?php
				}
				}
			?>
		</div>
		</div>


		<div class="columns">
		<div class="column col-6 centered">
			<h1><b><u> Departure Times/Locations</u></b></h1>
			<?php
				while ($depart_buses = mysqli_fetch_assoc($result_depart)) {
					if($depart_buses["available_on_saturday"] == "no")
					{
						?>
							<li style="background-color:yellow" type="square">
						<?php 
							$date = new DateTime($depart_buses["departure_time"]);
    						echo $date->format('h:i A') ;
						?> , From Lambton College Toronto to  
					<b><?php echo $depart_buses["departure_to"]; ?> </b>
				</li>
					<?php
					}
						else
						{
					?>
					<li type="square">
					<?php 
							$date = new DateTime($depart_buses["departure_time"]);
    						echo $date->format('h:i A') ;
					?> , From Lambton College Toronto to  
					<b><?php echo $depart_buses["departure_to"]; ?> </b>
				</li>
				<?php
				}
				}
			?>
		</div>
		</div>

		<div class="columns">

			<div class="column col-6 centered">
		<p style="color:red;">* Highlighted in Yellow are not available on Saturdays.</p>
			</div>
		</div>
	</div> <!-- // container -->
  
 <?php include("footer.php"); ?>