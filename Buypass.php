<?php include("header.php"); ?>
<?php include("db_functions.php") ?>

<?php
session_start();
?>



	<div class="container">
	  <div class="columns">
		<div class="column col-6 centered">
			<h1> Bus pass information</h1>
      <p> Valid and current ID containing a photo is required to purchase term bus pass.
        Term bus passes are valid upto to the end of the academic term </p><br>
        <p>Daily passes are also sold which expire in an hour </p>
				<p><mark> To check whether you already have bus pass, enter your student ID below </mark></p><br>


				<div class="input-group">
				<form action="" method ="get">
							 Student ID: <input type='text' name='passinfo' id = 'passinfo' /><br>
							 <button class="btn btn-primary input-group-btn">Check</button>
				</form>
				</div>

				<?php

				if (isset($_GET['passinfo'])){
					$studentid = $_GET['passinfo'];

         $db = connect();
					$resultp =  get_buspass_info($studentid);
					$studentdetails = mysqli_fetch_assoc($resultp);


         if ($studentdetails['Bus_pass'] == True)
				 {?>

				 <h5><mark><?php
					 echo $studentdetails['Name']. ", you already have a pass!";
					 ?><small class="label"></small></mark></h5>
					 <?php
				 }
				else {

					?>

					<h5><?php

									echo "No pass information available. Please buy a pass using the below information ";
									?><small class="label"></small></h5>
<?php


			}

 }
?>







<div class="mt-2"></div>
<h2> Enter your student ID and name to buy a pass! <small class="label"></small></h2>



         <div class="input-group">
				 <form id = 'form1' name = 'form1' action='' method='POST'>
                Student ID: <input type='text' name='studentid' id = 'studentid' /><br>
								Name:      <input type='text' name='namestudent' id = 'namestudent' /><br>
								<button type="submit" class="btn btn-primary input-group-btn">Buy pass</button>

        </form>
				</div>
<?php

//echo $_SESSION['studentid'];
				

				?><h5><?php
								if($_SERVER['REQUEST_METHOD']=='POST')
								{
								echo " Bus pass purchased on ".date('Y-m-d H:i:s', time());
								?><small class="label"></small></h5>


								<h5><mark><?php
								date_default_timezone_set('EST');
								   echo " Your bus pass will expire on April 30th, 2018";
								?><small class="label"></small></mark></h5>

		<?php
		}

		$db = connect();
		if($_SERVER['REQUEST_METHOD'] == 'POST') {

		  $name = $_POST['namestudent'];
		  $id = $_POST['studentid'];

     if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				exit();
			}
    //$sql =  "SELECT EXISTS (";
			$sql = " SELECT * from student ";
			$sql .= " where Student_ID = ";
			$sql .= "'" . $id . "'";

			$sql .= " ; ";


			$result1 = mysqli_query($db, $sql);

			$idexists = mysqli_fetch_assoc($result1);

			if ($idexists['Student_ID']== $id )


 {


	$sql =  "UPDATE student SET ";
	$sql .= " Bus_pass = True ";
	$sql .= " WHERE Student_ID = ";
	$sql .= "'" . $id . "'";
  $sql .= ";";

	$result2 = mysqli_query($db, $sql);

	if ($result2 == TRUE)
	 {
		$new_id = mysqli_insert_id($db);
		echo "Congratulations you bought a pass!";

	 // header("Location: " . "schedule.php");
	 // exit();

	}
	else {
		echo "INSERT failed. <br/>";
		echo "SQL command: " . $sql;

		// print out a the error
		echo "".mysqli_error($db);

	 }
}
else {
      $sql =  "INSERT INTO student";
		  $sql .= " (Student_ID, Name, Bus_pass)";
		  $sql .= " VALUES (";
		  $sql .= "'" . $id . "',";
		  $sql .= "'" . $name . "',";
		  $sql .= " True ";
		  $sql .=");";

		  $result3 = mysqli_query($db, $sql);
      echo $result3;
		  if ($result3 == TRUE)
		   {
		    $new_id = mysqli_insert_id($db);
		    echo "Congratulations you bought a pass!";

		   }
		  else {
		    echo "INSERT failed. <br/>";
		    echo "SQL command: " . $sql;

		    // print out a the error
		    echo "".mysqli_error($db);

		   }

		}

	}
		?>


		</div>
		</div>
		</div>
		</div>
