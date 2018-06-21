
<?php

require_once "Classes/PHPExcel.php";
		//$tmpfname = "test.xlsx";
		$url = "VideoTable.xlsx";
		$filecontent = file_get_contents($url);
		$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
		file_put_contents($tmpfname,$filecontent);

		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();


		for ($i = 1; $i <= $lastRow; $i++) {
			$artist_name[] = $worksheet->getCell('A'.$i)->getValue();
      $channel_name[] = $worksheet->getCell('B'.$i)->getValue();
      $song_name[] = $worksheet->getCell('C'.$i)->getValue();
      $video_desc[] = $worksheet->getCell('D'.$i)->getValue();
      $youtube_link[] = $worksheet->getCell('E'.$i)->getValue();
		}
		echo COUNT($youtube_link);
?>
