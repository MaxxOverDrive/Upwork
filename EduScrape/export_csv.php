<?php

  while($bppe1_scrape_Row = mysqli_fetch_assoc($bppe1_scrape_Var)) {
    $csv_array = array($bppe1_scrape_Row['school_scrape'], $bppe1_scrape_Row['phone_scrape'], $bppe1_scrape_Row['city_scrape'], $bppe1_scrape_Row['county_scrape']);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=schoolData.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, $csv_array);

    echo $bppe1_scrape_Row['school_scrape'];
    echo $bppe1_scrape_Row['phone_scrape'];
    echo $bppe1_scrape_Row['city_scrape'];
    echo $bppe1_scrape_Row['county_scrape'];

  }
  fclose($output);

?>
