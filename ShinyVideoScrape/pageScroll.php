<?php


$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

      $pageScrollSQL = "";
      $pageScrollResult = mysqli_query($conn, $verifySQL);

    if(mysqli_affected_rows($conn) > 0) {
      echo(" ");
      header('location:verify.php');
    }

    mysqli_close($conn);
}
?>
