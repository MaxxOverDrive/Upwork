<?php
$GLOBALS['school_check_Result'] = $school_check_Result;
$school_check_Var = $GLOBALS['school_check_Result'];

while($school_Row = mysqli_fetch_assoc($school_check_Var)) {
  $school_id = $school_Row['id'];
  $current_school = $school_Row['school'];
  $current_phone = $school_Row['phone'];
  $current_city = $school_Row['city'];
  $current_county = $school_Row['county'];

  if(($current_phone === $new_phone) && ($current_city === $city_scrape) && ($current_county === $county_scrape)) {
    $same_row++;
  }
  else { ?>
    <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $current_school; ?></td>
<?php
      if($current_city == NULL) {
        $city_info_SQL = "UPDATE `BPPE1` SET `city` = '$city_scrape' WHERE `BPPE1`.`id` = '$school_id'";
        $city_info_Result = mysqli_query($conn, $city_info_SQL);
        $newCity++; ?>
        <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $city_scrape; ?></td>
    <?php
      }//IF CURRENT CITY IS NULL
      else {

        if($current_city === $city_scrape) { ?>
          <td scope='col' style='border: 1px solid black;'><?php echo $current_city; ?></td>
    <?php }
        else {

          if($current_phone == NULL) {
            $phone_info_SQL = "UPDATE `BPPE1` SET `phone` = $new_phone' WHERE `BPPE1`.`id` = '$school_id'";
            $phone_info_Result = mysqli_query($conn, $phone_info_SQL);
            $newPhoneNumber++; ?>
            <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $new_phone; ?></td>
    <?php }
          else {

            if($current_phone === $new_phone) { ?>
              <td scope="col" style="border: 1px solid black; font-size: 105%; font-weight: bold;"><?php echo $current_phone; ?></td>
      <?php
              if($current_county == NULL) {
                $county_info_SQL = "UPDATE `BPPE1` SET `county` = $county_scrape' WHERE `BPPE1`.`id` = '$school_id'";
                $county_info_Result = mysqli_query($conn, $county_info_SQL);
                $newCounty++;?>
                <td scope="col" style="border: 1px solid black; font-size: 105%; font-weight: bold;"><?php echo $county_scrape; ?></td>
        <?php }
              else {

                if($current_county === $county_scrape) { ?>
                    <td scope="col" style="border: 1px solid black; font-size: 105%; font-weight: bold;"><?php echo $current_county; ?></td>
         <?php  }
                else {
                  include('AddAllRows.php');
                }//CURRENT COUNTY NOT EQUAL TO COUNTY SCRAPE

              }//CURRENT COUNTY NOT EQUEL TO COUNTY SCRAPE

            }//CURRENT PHONE NOT EQUAL TO NEW PHONE

          }//PHONE IS NOT EQUAL TO NULL

        }//CURRENT CITY NOT EQUAL TO CITY SCRAPE

      }//ELSE CURRENT CITY IS NOT NULL

    }//ELSE PHONE CIT AND COUNTY ARE NOT EQUAL

  }//END OF CURRENT SCHOOL WHILE LOOP

?>
