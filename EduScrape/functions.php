<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

  if(isset($_POST['compare_submit'])) {
    

    $conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

    if(!$conn) {
    	die("Connection Failed: " . mysqli_connect_error());
    }
    else {

      ?>

     <div class="col-md-12" style="height: 100%; border: 2px solid grey;">
       <table class="table table-striper table-hover dataTable">
         <thead style="font-weight: bold; font-size: 115%;" class="text-center">
           <tr>
             <td scope="col">School</td>
             <td scope="col">Phone</td>
             <td scope="col">City</td>
             <td scope="col">County</td>
           </tr>
         </thead>
         <tbody>

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

         $total = 0;
         $newSchool = 0;
         $newPhoneNumber = 0;
         $newCity = 0;
         $newCounty = 0;
         $newMailingAddress = 0;
         $newPhysicalAddress = 0;
         $same_school = 0;
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
                   $school = trim($school_pages[1][0]);
                   $phone = trim($school_pages[1][1]);
                   $replace_array = array(')', '(', ' ');
                   $new_phone = trim(str_replace($replace_array, '', $phone));
                   $schoolCode = trim($school_pages[1][2]);
                   $county = trim($school_pages[1][3]);
                   $mailingAddress = trim(preg_replace('/&nbsp;|<br \/>/', '', $school_pages[1][4]));
                   $physicalAddress = trim(preg_replace('/&nbsp;|<br \/>/', '', $school_pages[1][5]));
                 if($a > 7) {
                   array_push($approvedPrograms, $school_pages[1][$a]);
                 }
               }

               $approvedPrograms = implode(',', preg_replace('/<strong>|<\/strong>/', '', $approvedPrograms));
               $school_check_SQL = mysqli_query($conn, "SELECT * FROM BPPE1 WHERE school_code='$schoolCode'");

               if(mysqli_num_rows($school_check_SQL) > 0) {
                 $same_school++;
               }
               else {
                 $all_school_info_SQL = "INSERT INTO BPPE1 (school, phone, school_code, county, mailing_address, physical_address, approved_programs)
                                         VALUES ('$school', '$new_phone', '$schoolCode', '$county', '$mailingAddress', '$physicalAddress', '$approvedPrograms')";
                 $all_school_info_Result = mysqli_query($conn, $all_school_info_SQL);

                 $newSchool++;
                 $newPhoneNumber++;
                 $newCity++;
                 $newCounty++;
                 $newMailingAddress++;
                 $newPhysicalAddress++;
                 ?>
                 <tr>
                   <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $school; ?></td>
                   <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $new_phone; ?></td>
                   <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $county; ?></td>
                   <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $mailingAddress; ?></td>
                   <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $physicalAddress; ?></td>
                   <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $approvedPrograms; ?></td>
                 </tr>
                 <?php
               }
               $total++;
             }
           }
         }
         curl_close($curl);

        if(isset($_POST['export_csv'])) {

          for($csv1 = 0; $csv1 <= COUNT($school); $csv1++) {
            $csv_array = array($school[$csv1], $new_phone[$csv1], $county[$csv1], $mailingAddress[$csv1], $physicalAddress[$csv1], $approvedPrograms[$csv1]);
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=schoolData.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, $csv_array);
            ?>
            <tr>
              <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $school[$csv1]; ?></td>
              <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $new_phone[$csv1]; ?></td>
              <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $county[$csv1]; ?></td>
              <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $mailingAddress[$csv1]; ?></td>
              <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $physicalAddress[$csv1]; ?></td>
              <td scope="col" style="border: 1px solid black; color: red; font-size: 105%; font-weight: bold;"><?php echo $approvedPrograms[$csv1]; ?></td>
            </tr>
            <?php
          }
          fclose($output);
        }

      }//END IF ISSET

      if(mysqli_affected_rows($conn) > 0) {
        echo "<h3>" .$newSchool . " Schools detals have been entered</h3>";
        echo "<h3>" .$same_school . " Schools that where the same</h3>";
        echo "<h3>" .$total . " Total Scraped</h3>";
      }
      else {
        echo "No info has been entered";
      }
      mysqli_close($conn);

    }
    else {
        echo '<h1 style="text-align: center; font-family: Garmond;">Results displayed here</h1>';
    }
  echo "</tbody></table>";
?>
