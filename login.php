
<?php include("header.php"); ?>

<?php require_once("db_functions.php") ?>
<?php
session_start(); 

	if (isset($_SESSION['logged']) == TRUE )
		{
 		header("Location: " . "admin_schedule.php");
 		exit();
		}

?>
<?php
$db = connect();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	session_start(); 

	if (isset($_SESSION['logged']) == TRUE )
		{
 		header("Location: " . "admin_schedule.php");
 		exit();
		}
  $username = $_POST['user'];
  $pass = $_POST['pass'];
	$user = mysqli_fetch_assoc(get_user());
	if($username ==	 $user['user_name'] && $pass == $user['password'])
	{

		$_SESSION['logged'] = TRUE ;
		header("Location: " . "admin_schedule.php");
	}
	else{
		
		?>
		<script>
			alert("Wrong username or password");
		</script>
		<?php
	}

}
?>



	<div class="container">
	  <div class="columns">
		<div class="column col-2 col-mx-auto">

	<form action="" method="POST">
	
	<legend> Log-In here </legend>
	<label class="form-label">Username </label>
	<input class="form-input" type="text" name="user" size="40" placeholder="User Name">
	<label class="form-label">Password </label>
	<input class="form-input" type="Password" name="pass" size="40" placeholder="Password"><br>
	<button class="btn btn-primary" type="submit" name="submit">Log-in </button>
</form>

</div></div></div>
<?php include("footer.php"); ?>