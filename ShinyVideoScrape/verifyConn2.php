<?php


$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

    $N = count($verify);

    for($i=0; $i < $N; $i++)	{

      $verifySQL = "UPDATE `VideoURL` SET `verified` = 'Verified' WHERE `VideoURL`.`id` = '$verify'";
      $verifyResult = mysqli_query($conn, $verifySQL);
    }

    if(mysqli_affected_rows($conn) > 0) {
      echo("You verified $N video(s): ");
      header('location:verify.php');
    }

    mysqli_close($conn);
}
?>
