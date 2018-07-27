<?php



$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

    $checkSQL = "SELECT youtube_link FROM VideoURL";

    $checkResult = mysqli_query($conn, $checkSQL);

    if(mysqli_num_rows($checkResult) > 0) {

      $GLOBALS['chechResult'] = $checkResult;

    }

    else {
      echo "No Connection";
    }

    $youtube_link = $_POST['youtube_link'];

    $checkVar = $GLOBALS['checkResult'];

    while($checkRow = mysqli_fetch_assoc($checkVar)) {
      $checkArray[] = $checkRow['youtube_link'];
    }

    if(in_array($youtube_link, $checkArray)) {
      echo "<h3>This link already exists, Please choose another!</h3>";
    }

    else {

      $artist_name = $_POST['artist_name'];
      $channel_name = $_POST['channel_name'];
      $song_name = $_POST['song_name'];
      $video_desc = $_POST['video_desc'];
      $verified = '';

      $insertSQL = "INSERT INTO VideoURL (artist_name, channel_name, song_name, video_desc, youtube_link, verified)
                    VALUES ('$artist_name', '$channel_name', '$song_name', '$video_desc', '$youtube_link', '$verified')";

      $insertResult = mysqli_query($conn, $insertSQL);

      if(mysqli_affected_rows($conn) > 0) {
        echo "<h3>Your information has been entered!</h3>";
        header('location:index.php');
      }

      else {
        echo "Nothing Happened!";
      }

    }

  }
  mysqli_close($conn);

?>
