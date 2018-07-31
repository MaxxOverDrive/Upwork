<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

  $page1 = file_get_contents("0WebScrape.txt");
  $rep1 = preg_replace('/<a[^>]*>/', '<tr><td style="width:20%;">', preg_replace('/<td[^>]*>(.*?)<\/strong>|<table[^>]*>(.*)<\/div>|<td>|<\/a>/', '', $page1));
  $rep2 = explode('<tr>', $rep1);
  $newSchool = 0;
  $newPhoneNumber = 0;
  $newCity = 0;
  $newCounty = 0;
  $same_row = 0;

  $csv_array = array();
  for($p1 = 1; $p1 < COUNT($rep2); $p1++) {
    ini_set('memory_limit', '1024M');
    ini_set('max_execution_time', 300);

    $rep3 = preg_split('/<td[^>]*>/', $rep2[$p1]);
    $school_scrape = trim($rep3[1]);
    $phone_scrape = $rep3[2];
    $replace_array = array(')', '(', ' ');
    $new_phone = trim(str_replace($replace_array, '', $phone_scrape));
    $city_scrape = trim($rep3[3]);
    $county_scrape = trim($rep3[4]);

    $school_check_SQL = "SELECT * FROM BPPE1 WHERE school='$school_scrape'";
    $school_check_Result = mysqli_query($conn, $school_check_SQL);

        if(mysqli_num_rows($school_check_Result) > 0) {
          $GLOBALS['school_check_Result'] = $school_check_Result;
          $school_check_Var = $GLOBALS['school_check_Result'];

          while($school_Row = mysqli_fetch_assoc($school_check_Var)) {
            $school_id[] = $school_Row['id'];
            $current_school[] = $school_Row['school'];
            $current_phone[] = $school_Row['phone'];
            $current_city[] = $school_Row['city'];
            $current_county[] = $school_Row['county'];
            }//END OF CURRENT SCHOOL WHILE LOOP

            for($s = 0; $s <= COUNT($current_school); $s++) {
              if(($current_phone[$s] === $new_phone) && ($current_city[$s] === $city_scrape) && ($current_county[$s] === $county_scrape)) {
                $same_row_check[] = array($current_school[$s], $current_phone[$s], $current_city[$s], $current_county[$s]);
              }
             }//END OF FOR LOOP OF CURRENT SCHOOLS

            if(COUNT($same_row_check) > 0) {
              $same_row++;
            }
            else {
              include('addAllRows.php');
            }

        }//END OF IF SCHOOL EXISTS
        else {//SCHOOL DOES NOT EXIST
          include('addAllRows.php');
        }//END OF ELSE SCHOOL DOES NOT EXIST

  }//END OF MAIN FOR LOOP
  echo "</table>";

?>
