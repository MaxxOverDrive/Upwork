<?php

$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

    $searchSQL = "SELECT * FROM VideoURL WHERE song_name LIKE '%$user_search%' ORDER BY song_name";
    $tableSQL = "SELECT artist_name, channel_name, song_name, video_desc, youtube_link FROM VideoURL LIMIT 10";

    $searchResult = mysqli_query($conn, $searchSQL);
    $tableResult = mysqli_query($conn, $tableSQL);

    if(mysqli_num_rows($searchSQL) > 0) {
      $GLOBALS['searchSQL'] = $searchSQL;
    }
    else {
      echo "<h1>There are no results found</h1>";
    }

    if(mysqli_num_rows($tableResult) > 0) {
      $GLOBALS['tableResult'] = $tableResult;
    }
    else {
      echo "<h1>There are no results found</h1>";
    }
  }
  mysqli_close($conn);
?>
