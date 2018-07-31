<?php

$url1 = "https://app.dca.ca.gov/bppe/view-voc-names.asp?schlname=&city=&county=&program=&program_keyword=&intJump=0&intRecords=2000";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);

if(preg_match_all('/(.*?)<\/td>/', $result, $bppe1_matches)) {
  foreach($bppe1_matches[1] as $bppe1_match) {
    $school_Row[] = trim(str_replace('<td>&nbsp;', '', $bppe1_match));
  }
}
curl_close($ch);

$newSchool = 0;
$newPhoneNumber = 0;
$newCounty = 0;
$newMailingAddress = 0;
$newPhysicalAddress = 0;
$new_approved_program = 0;
$same_school = 0;
$total = 0;

$curl = curl_init();

for($i = 18; $i < (COUNT($school_Row) - 3); $i++) {
  ini_set('memory_limit', '1024M');
  ini_set('max_execution_time', 300);
  $school_URL = "https://app.dca.ca.gov/bppe/";

  if(preg_match('/<a href=".*?([\s\S]*?)">/', $school_Row[$i], $school_URL_matches)) {
    curl_setopt($curl, CURLOPT_URL, $school_URL.$school_URL_matches[1]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $school_result = curl_exec($curl);

    if(preg_match_all('/<td>([\s\S]*?)<\/td>/', $school_result, $school_pages)) {
      $approvedPrograms = array();
      for($a = 0; $a < COUNT($school_pages[1]); $a++) {
          $school_scrape = trim($school_pages[1][0]);
          $phone_scrape = trim($school_pages[1][1]);
          $replace_array = array(')', '(', ' ');
          $new_phone = trim(str_replace($replace_array, '', $phone_scrape));
          $school_code_scrape = trim($school_pages[1][2]);
          $county_scrape = trim($school_pages[1][3]);
          $mailing_address_scrape = trim(preg_replace('/&nbsp;|<br \/>|\n/', '', $school_pages[1][4]));
          $physical_address_scrape = trim(preg_replace('/&nbsp;|<br \/>|\n/', '', $school_pages[1][5]));
        if($a > 7) {
          array_push($approvedPrograms, trim($school_pages[1][$a]));
        }
      }

      $comp_approved_programs = sort($approvedPrograms);
      $approved_programs_scrape = implode(',', preg_replace('/<strong>|<\/strong>/', '', $approvedPrograms));
      $school_check_SQL =  "SELECT * FROM BPPE1_Scrape WHERE school_code='$school_code_scrape'";
      $school_check_Result = mysqli_query($conn, $school_check_SQL);

      if(mysqli_num_rows($school_check_Result) > 0) {
        include('compare.php');
      }
      else {


        $all_school_info_scrape_SQL = "INSERT INTO BPPE1_Scrape (school, phone, school_code, county, mailing_address, physical_address, approved_programs)
                                       VALUES ('$school_scrape', '$new_phone', '$school_code_scrape', '$county_scrape', '$mailing_address_scrape', '$physical_address_scrape', '$approved_programs_scrape')";
        $all_school_info_scrape_Result = mysqli_query($conn, $all_school_info_scrape_SQL);

        $newSchool++;
        $newPhoneNumber++;
        $newCounty++;
        $newMailingAddress++;
        $newPhysicalAddress++;
        $new_approved_program++;
        /*
        ?>
        <tr>
          <td><input type="checkbox" class="form-check-input" name="export_selected" value="<?php echo $tableRow['id']; ?>"></td>
          <td style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $school_scrape; ?></td>
          <td style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $new_phone; ?></td>
          <td style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $county_scrape; ?></td>
          <td style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $mailing_address_scrape; ?></td>
          <td style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $physical_address_scrape; ?></td>
          <td style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $approved_programs_scrape; ?></td>
        </tr>
        <?php
        */
      }
      $total++;
    }
  }
}
curl_close($curl);

?>
