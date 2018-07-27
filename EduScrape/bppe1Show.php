<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');



$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

if(!$conn) {
  die("Connection Failed: " . mysqli_connect_error());
}
else {
  $bppe1_SQL = "SELECT * FROM BPPE1 ORDER BY school";
  $bppe1_Result = mysqli_query($conn, $bppe1_SQL);

  if(mysqli_num_rows($bppe1_Result) > 0) {
    $GLOBALS['bppe1_Result'] = $bppe1_Result;
  }
  else {
    echo "There are no Schools";
  }
$bppe1_Var = $GLOBALS['bppe1_Result'];

while($bppe1_Row = mysqli_fetch_assoc($bppe1_Var)) {
     $bppe1_school[] = $bppe1_Row['school'];
     $bppe1_phone[] = $bppe1_Row['phone'];
     $bppe1_city[] = $bppe1_Row['city'];
     $bppe1_county[] = $bppe1_Row['county'] . "<br>";
}

echo COUNT($bppe1_school) . " Current Schools <br>";
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
