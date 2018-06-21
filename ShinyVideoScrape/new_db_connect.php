<?php


// TABLE POST VARIABLES
$artist_name = $_POST['artist_name'];
$channel_name = $_POST['channel_name'];
$song_name = $_POST['song_name'];
$video_desc = $_POST['video_desc'];
$youtube_link = $_POST['youtube_link'];

$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {

    include("Classes/PHPExcel.php");

    $tmpfname = "VideoTable.xlsx";
    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    $excelObj = $excelReader->load($tmpfname);
    $worksheet = $excelObj->getActiveSheet();
    $lastRow = $worksheet->getHighestRow();

    //Searching the excel sheet
    for($i = 1; $i <= $lastRow; $i++) {
      $artist_name[] = $worksheet->getCell('A'.$i)->getValue();
      $channel_name[] = $worksheet->getCell('B'.$i)->getValue();
      $song_name[] = $worksheet->getCell('C'.$i)->getValue();
      $video_desc[] = $worksheet->getCell('D'.$i)->getValue();
      $youtube_link[] = $worksheet->getCell('E'.$i)->getValue();


    }
    echo COUNT($youtube_link);

    for($n = 0; $n < COUNT($youtube_link); $n++) {
      $videoSQL = "INSERT INTO VideoURL (artist_name, channel_name, song_name, video_desc, video_link)
                         VALUES ('$artist_name[$n]', '$channel_name[$n]', '$song_name[$n]', '$video_desc[$n]', '$video_link[$n]')";
      $videoResult = mysqli_query($conn, $videoSQL);
    }



    if(mysqli_affected_rows($conn) > 0) {
      echo "Show Me Titties!";
    }
    else {
      echo "NO TITTIES FOR YOU!";
    }

  }
mysqli_close($conn);
 ?>
