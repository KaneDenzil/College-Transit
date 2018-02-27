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


  if (isset($_GET["pickid"]) == FALSE && isset($_GET["departid"]) == FALSE) 
  {
  // missing an id parameters, so   
    header("Location: " . "admin_schedule.php");
    exit();
  }

  // delete the pickid

 if(isset($_GET["pickid"]) == true)
 {
  $id=$_GET["pickid"];
  ?>
  <script>
    confirm("Are You Sure You Want To Delete ?");
  </script>

  <?php
  delete_pickup($id);

}

if(isset($_GET["departid"]) == true)
 {
  $id=$_GET["departid"];
  ?>
  <script>
    confirm("Are You Sure You Want To Delete ?");
  </script>

  <?php
  delete_departure($id);
 }


?>
    