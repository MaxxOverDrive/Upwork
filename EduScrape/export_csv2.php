<?php

while($scraped_table_Row = mysqli_fetch_assoc($scraped_table_Var)) {
  ini_set('memory_limit', '1024M');
  ini_set('max_execution_time', 300);
  $csv_array = array($csv_db_array['school'], $csv_db_array['phone'], $csv_db_array['county'], $csv_db_array['mailing_address'], $csv_db_array['physical_address'], $csv_db_array['approvedPrograms']);
  //$csv_array = array($scraped_table_Row['school'], $scraped_table_Row['phone'], $scraped_table_Row['county'], $scraped_table_Row['mailing_address'], $scraped_table_Row['physical_address'], $scraped_table_Row['approved_programs']);
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=schoolData.csv');
  $output = fopen("php://output", "w");
  fputcsv($output, $csv_array);
}
fclose($output);

?>
