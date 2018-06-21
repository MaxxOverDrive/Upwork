<?php


$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

  if(!$conn) {
    die('error msg' . mysqli_connect_error());
  }
  else {
    ini_set('memory_limit', '1024M');

    $artist_name = $_POST['artist_name'];
    $channel_name = $_POST['channel_name'];
    $song_name = $_POST['song_name'];
    $video_desc = $_POST['video_desc'];
    $youtube_link = $_POST['youtube_link'];
  }
    require_once "Classes/PHPExcel.php";

    $tmpfname = "VideoTable.xlsx";
    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    $excelObj = $excelReader->load($tmpfname);
    $worksheet = $excelObj->getActiveSheet();
    $lastRow = $worksheet->getHighestRow();

    $i = 0;

    //Searching the excel sheet
    for($r = 1; $r <= $lastRow; $r++) {

        $artist_name[$i] = $worksheet->getCell('A'.$r)->getValue();
        $channel_name[$i] = $worksheet->getCell('B'.$r)->getValue();
        $song_name[$i] = $worksheet->getCell('C'.$r)->getValue();
        $video_desc[$i] = $worksheet->getCell('D'.$r)->getValue();
        $youtube_link[$i] = $worksheet->getCell('E'.$r)->getValue();


        $sql = "INSERT INTO VideoURL (artist_name, channel_name, song_name, video_desc, youtube_link)
                 VALUES ('$artist_name[$i]', '$channel_name[$i]', '$song_name[$i]', '$video_desc[$i]', '$youtube_link[$i]')";

        $result = mysqli_query($conn, $sql);

        $i++;
    }


    if(mysqli_affected_rows($conn) > 0) {

      echo COUNT($youtube_link) . "URLs should be entered!";
    }
    else {
      echo "No Things Entered!";
    }

  mysqli_close($conn);
  ?>
