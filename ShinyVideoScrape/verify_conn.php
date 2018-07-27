<?php

$db_host = "";
$db_username = "";
$db_pass = "";
$db_name = "";

$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

    $tableSQL = "SELECT * FROM VideoURL WHERE verified = '' LIMIT 25";

    $tableResult = mysqli_query($conn, $tableSQL);

    if(mysqli_num_rows($tableResult) > 0) {
      $GLOBALS['tableResult'] = $tableResult;
    }
    else {
      echo "<h1>There are no results found</h1>";
    }
  }
  mysqli_close($conn);
?>
