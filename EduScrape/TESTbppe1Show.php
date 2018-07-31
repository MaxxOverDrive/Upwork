<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');



$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

if(!$conn) {
  die("Connection Failed: " . mysqli_connect_error());
}
else {

  $bppe1_scrape_compare_SQL = "SELECT * FROM BPPE1_Scrape ORDER BY school";
  $bppe1_scrape_compare_Result = mysqli_query($conn, $bppe1_scrape_compare_SQL);

  if(mysqli_num_rows($bppe1_scrape_compare_Result) > 0) {
    $GLOBALS['bppe1_scrape_compare_Result'] = $bppe1_scrape_compare_Result;
  }

$bppe1_scrape_compare_Var = $GLOBALS['bppe1_scrape_compare_Result'];



while($bppe1_scrape_Row = mysqli_fetch_assoc($bppe1_scrape_compare_Var)) {
     $scraped_school_id[] = $bppe1_scrape_Row['id'];
     $scraped_school_code[] = $bppe1_scrape_Row['school_code'];
     $scraped_school[] = $bppe1_scrape_Row['school'];
     $scraped_phone[] = $bppe1_scrape_Row['phone'];
     $scraped_county[] = $bppe1_scrape_Row['county'];
     $scraped_mailing_address[] = $bppe1_scrape_Row['mailing_address'];
     $scraped_physical_address[] = $bppe1_scrape_Row['physical_address'];
     $scraped_approved_programs_temp = explode(',', $bppe1_scrape_Row['approved_programs']);
     $scraped_approved_programs[] = sort($scraped_approved_programs_temp);
}


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

for($b1 = 0; $b1 < COUNT($bppe1_school); $b1++) {
  ?>
  <tr>
    <td scope="col" style="border: 1px solid black; font-size: 105%; font-weight: bold;"><?php echo $bppe1_school[$b1]; ?></td>
    <td scope="col" style="border: 1px solid black; font-size: 105%; font-weight: bold;"><?php echo $bppe1_phone[$b1]; ?></td>
    <td scope="col" style="border: 1px solid black; font-size: 105%; font-weight: bold;"><?php echo $bppe1_city[$b1]; ?></td>
    <td scope="col" style="border: 1px solid black; font-size: 105%; font-weight: bold;"><?php echo $bppe1_county[$b1]; ?></td>
  </tr>
  <?php
}
echo "</table>";

}//END CONNECT ELSE

mysqli_close($conn);

?>
