<?php include("header.php"); ?>

	<div class="container">
	  <div class="columns">
		<div class="column col-6 centered">
			<h1> Bus ticket information</h1>
      <p> Valid and current ID containing a photo is required to show with the temporary bus ticket while entering the bus.
        Bus tickets are valid upto the end of the day </p><br>
        <p>Term bus passes are also sold for the entire academic term </p>

<?php
				/* This sets the $time variable to the current hour in the 24 hour clock format */
				$time = date("H");
				/* Set the $timezone variable to become the current timezone */
				$timezone = date("e");
				/* If the time is less than 1200 hours, show good morning */
				if ($time < "12") { ?>
						<p><mark> <?php echo "Good morning! Currently the tickets are sold for 9 dollars, thanks!"; ?> </mark></p>

						<?php
				} else
				/* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
				if ($time >= "12" && $time < "17") {?>
						<p><mark> <?php
						echo "Good afternoon! Currently the tickets are sold for 8 dollars, thanks! "; ?> </mark></p>

						<?php
				} else
				/* Should the time be between or equal to 1700 and 1900 hours, show good evening */
				if ($time >= "17" && $time < "19") {?>
						<p><mark> <?php
						echo "Good evening! Currently the tickets are sold for 5 dollars, thanks!";?> </mark></p>

						<?php
				} else
				/* Finally, show good night if the time is greater than or equal to 1900 hours */
				if ($time >= "19") {?>
						<p><mark> <?php 
						echo "Good evening! Current price is 2 dollars";?> </mark></p>

						<?php
				}
?>



				<div class="input-group">
			 <form id = 'form1' name = 'form1' action='' method='POST'>

							<button type="submit" name = 'bb' class="btn btn-primary input-group-btn">Buy a ticket</button>
			 </form>
			</div>

			<?php
			session_start();

			if($_SERVER['REQUEST_METHOD']=='POST')
           {
           	if (!isset($_SESSION["count"]) )
           	{
			$_SESSION["count"]=1;
			}
			else
			{
				$_SESSION["count"]+=1;
			}
				if ($_SESSION["count"] > 5)
				{
					session_destroy();	
				?>

				<p><mark>Sorry the bus full. Please try again tomorrow <small class="label"></mark></small></p>

				<?php

				}
			else
			{
			perform();
			}
	}
			

			function perform()
			{
			
				?>
			<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo date('Y-m-d H:i:s', time());  ?>" title="Link to Google.com" />

			<h5><?php


 				echo " Bus ticket for ".date('Y-m-d H:i:s', time());
 				?><small class="label"></small></h5>


 				<h5><mark><?php
 				date_default_timezone_set('EST');
 					 echo " Your bus ticket will expire in 1 hour i.e at ".date('H:i:s', strtotime('1 hour'));
 				?><small class="label"></small></mark></h5>

<?php	}
 ?>
