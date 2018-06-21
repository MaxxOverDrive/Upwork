<?php


$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

    $artist_name = $_POST['artist_name'];
    $channel_name = $_POST['channel_name'];
    $song_name = $_POST['song_name'];
    $video_desc = $_POST['video_desc'];
    $youtube_link = $_POST['youtube_link'];

    $checkSQL = "SELECT * FROM VideoURL WHERE youtube_link == '$youtube_link'";
    $checkResult = mysqli_query($conn, $checkSQL);

    if(mysqli_num_rows($checkResult) > 0) {
      echo "<h3>This URL already exists</h3>";
    }
    else {

      $insertSQL = "INSERT INTO VideoURL (artist_name, channel_name, song_name, video_desc, youtube_link)
      VALUES ('$artist_name', '$channel_name', '$song_name', '$video_desc', '$youtube_link')";
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
