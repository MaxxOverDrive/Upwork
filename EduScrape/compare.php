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
      echo "<tr>";
      if($current_school === $school_scrape) {
        ?><td scope="col" style="border: 1px solid black;"><?php echo $current_school; ?></td><?php
        array_push($csv_db_array['school'], $current_school);
      }
      else {
        if($school_scrape != NULL) {
          $school_info_SQL = "UPDATE `BPPE1` SET `school` = '$school_scrape' WHERE `BPPE1`.`id` = '$school_id'";
          $school_info_Result = mysqli_query($conn, $school_info_SQL);
          array_push($csv_db_array['school'], $school_scrape);
          $newSchool++;
          ?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $school_scrape; ?></td><?php
        }
      }

      if($current_phone === $new_phone) {
        array_push($csv_db_array['phone'], $current_phone);
        ?><td scope="col" style="border: 1px solid black;"><?php echo $current_phone; ?></td><?php
      }
      else {
        if($new_phone != NULL) {
          $phone_info_SQL = "UPDATE `BPPE1` SET `phone` = '$new_phone' WHERE `BPPE1`.`id` = '$school_id'";
          $phone_info_Result = mysqli_query($conn, $phone_info_SQL);
          array_push($csv_db_array['phone'], $new_phone);
          $newPhoneNumber++;
          ?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $new_phone; ?></td><?php
        }
      }

      if($current_county === $county_scrape) {
        array_push($csv_db_array['county'], $current_county);
        ?><td scope="col" style="border: 1px solid black;"><?php echo $current_county; ?></td><?php
      }
      else {
        if($county_scrape != NULL) {
          $county_info_SQL = "UPDATE `BPPE1` SET `county` = '$county_scrape' WHERE `BPPE1`.`id` = '$school_id'";
          $county_info_Result = mysqli_query($conn, $county_info_SQL);
          array_push($csv_db_array['county'], $county_scrape);
          $newCounty++;
          ?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $county_scrape; ?></td><?php
        }
      }

      if($current_mailing_address === $mailing_address_scrape) {
        array_push($csv_db_array['mailing_address'], $current_mailing_address);
        ?><td scope="col" style="border: 1px solid black;"><?php echo $current_mailing_address; ?></td><?php
      }
      else {
        if($mailing_address_scrape != NULL) {
          $mailing_address_info_SQL = "UPDATE `BPPE1` SET `mailing_address` = '$mailing_address_scrape' WHERE `BPPE1`.`id` = '$school_id'";
          $mailing_address_info_Result = mysqli_query($conn, $mailing_address_info_SQL);
          array_push($csv_db_array['mailing_address'], $mailing_address_scrape);
          $newMailingAddress++;
          ?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $mailing_address_scrape; ?></td><?php
        }
      }

      if($current_physical_address === $physical_address_scrape) {
        array_push($csv_db_array['physical_address'], $current_physical_address);
          ?><td scope="col" style="border: 1px solid black;"><?php echo $current_physical_address; ?></td><?php
      }
      else {
        if($physical_address_scrape != NULL) {
          $physical_address_info_SQL = "UPDATE `BPPE1` SET `physical_address` = '$physical_address_scrape' WHERE `BPPE1`.`id` = '$school_id'";
          $physical_address_info_Result = mysqli_query($conn, $physical_address_info_SQL);
          array_push($csv_db_array['physical_address'], $physical_address_scrape);
          $newPhysicalAddress++;
          ?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $physical_address_scrape; ?></td><?php
        }
      }

      if($current_approved_programs === $comp_approved_programs) {
        array_push($csv_db_array['approvedPrograms'], $current_approved_programs);
        ?><td scope="col" style="border: 1px solid black;"><?php echo $current_approved_programs; ?></td><?php
      }
      else {
        if($approvedPrograms != NULL) {
          $approved_program_info_SQL = "UPDATE `BPPE1` SET `approved_programs` = '$approvedPrograms' WHERE `BPPE1`.`id` = '$school_id'";
          $approved_program_info_Result = mysqli_query($conn, $approved_program_info_SQL);
          array_push($csv_db_array['approvedPrograms'], $approvedPrograms);
          $new_approved_program++;
          ?><td scope="col" style="border: 1px solid black; color: red; font-size: 100%; font-weight: bold;"><?php echo $approvedPrograms; ?></td><?php
        }
      }
      echo "</tr>";

      /*
      $all_school_info_scrape_SQL = "INSERT INTO BPPE1_Scrape (school, phone, county, mailing_address, physical_address, approved_programs)
                                     VALUES ('', '', '', '', '', '')";
      $all_school_info_scrape_Result = mysqli_query($conn, $all_school_info_scrape_SQL);
      */

    }//END OF ELSE ALL IS NOT EQUAL

  }//END WHILE LOOP

?>
