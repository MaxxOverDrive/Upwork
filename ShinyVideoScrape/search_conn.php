<?php


$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

    $searchSQL = "SELECT * FROM VideoURL";

    $searchResult = mysqli_query($conn, $searchSQL);

      if(mysqli_num_rows($searchResult) > 0) {
        $GLOBALS['searchResult'] = $searchResult;
      }

      else {
        echo "<h1>There are no results found</h1>";
      }

    }
mysqli_close($conn);
?>
