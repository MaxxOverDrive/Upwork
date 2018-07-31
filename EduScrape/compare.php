<?php

  $GLOBALS['school_check_Result'] = $school_check_Result;
  $school_check_Var = $GLOBALS['school_check_Result'];

  while($school_check_Row = mysqli_fetch_assoc($school_check_Var)) {
    ini_set('memory_limit', '1024M');
    ini_set('max_execution_time', 300);

    $school_id = $school_check_Row['id'];
    $current_school_code = $school_check_Row['school_code'];
    $current_school = $school_check_Row['school'];
    $current_phone = $school_check_Row['phone'];
    $current_county = $school_check_Row['county'];
    $current_mailing_address = $school_check_Row['mailing_address'];
    $current_physical_address = $school_check_Row['physical_address'];
    $current_approved_programs_temp = explode(',', $school_check_Row['approved_programs']);
    $current_approved_programs = sort($current_approved_programs_temp);

    if(($current_school === $school_scrape) && ($current_phone === $new_phone) && ($current_county === $county_scrape) && ($current_mailing_address === $mailing_address_scrape) && ($current_physical_address === $physical_address_scrape) && ($current_approved_programs === $comp_approved_programs)) {
      $same_school++;
      break;
    }
    else {//ALL IS NOT EQUIAL
      //echo "<tr>";
      if($current_school !== $school_scrape) {
        if($school_scrape != NULL) {
          $school_info_SQL = "UPDATE `BPPE1_Scrape` SET `school` = '$school_scrape' WHERE `BPPE1_Scrape`.`id` = '$school_id'";
          $school_info_Result = mysqli_query($conn, $school_info_SQL);
          $newSchool++;
          /*?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $school_scrape; ?></td><?php*/
        }
      }

      if($current_phone !== $new_phone) {
        if($new_phone != NULL) {
          $phone_info_SQL = "UPDATE `BPPE1_Scrape` SET `phone` = '$new_phone' WHERE `BPPE1_Scrape`.`id` = '$school_id'";
          $phone_info_Result = mysqli_query($conn, $phone_info_SQL);
          $newPhoneNumber++;
          /*?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $new_phone; ?></td><?php*/
        }
      }

      if($current_county !== $county_scrape) {
        if($county_scrape != NULL) {
          $county_info_SQL = "UPDATE `BPPE1_Scrape` SET `county` = '$county_scrape' WHERE `BPPE1_Scrape`.`id` = '$school_id'";
          $county_info_Result = mysqli_query($conn, $county_info_SQL);
          $newCounty++;
          /*?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $county_scrape; ?></td><?php*/
        }
      }

      if($current_mailing_address !== $mailing_address_scrape) {
        if($mailing_address_scrape != NULL) {
          $mailing_address_info_SQL = "UPDATE `BPPE1_Scrape` SET `mailing_address` = '$mailing_address_scrape' WHERE `BPPE1_Scrape`.`id` = '$school_id'";
          $mailing_address_info_Result = mysqli_query($conn, $mailing_address_info_SQL);
          $newMailingAddress++;
          /*?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $mailing_address_scrape; ?></td><?php*/
        }
      }

      if($current_physical_address !== $physical_address_scrape) {
        if($physical_address_scrape != NULL) {
          $physical_address_info_SQL = "UPDATE `BPPE1_Scrape` SET `physical_address` = '$physical_address_scrape' WHERE `BPPE1_Scrape`.`id` = '$school_id'";
          $physical_address_info_Result = mysqli_query($conn, $physical_address_info_SQL);
          $newPhysicalAddress++;
          /*?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $physical_address_scrape; ?></td><?php*/
        }
      }

      if($current_approved_programs !== $comp_approved_programs) {
        if($approvedPrograms != NULL) {
          $approved_program_info_SQL = "UPDATE `BPPE1_Scrape` SET `approved_programs` = '$approvedPrograms' WHERE `BPPE1_Scrape`.`id` = '$school_id'";
          $approved_program_info_Result = mysqli_query($conn, $approved_program_info_SQL);
          $new_approved_program++;
          /*?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $approvedPrograms; ?></td><?php*/
        }
      }
      //echo "</tr>";

    }//END OF ELSE ALL IS NOT EQUAL

  }//END WHILE LOOP

?>
