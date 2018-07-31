<?php
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', 300);

$url1 = "https://app.dca.ca.gov/bppe/view-voc-names.asp?schlname=&city=&county=&program=&program_keyword=&intJump=0&intRecords=2000";
$url2 = "http://bppe.ca.gov/enforcement/inspection_results.shtml";
$url3 = "http://bppe.ca.gov/enforcement/disciplinary_actions.shtml";
$urlArray = array($url1, $url2, $url3);
$ch = curl_init();

for($a = 0; $a < COUNT($urlArray); $a++) {
  ini_set('memory_limit', '1024M');
  ini_set('max_execution_time', 300);
  curl_setopt($ch, CURLOPT_URL, $urlArray[$a]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $result = curl_exec($ch);

  //SCRAPE PAGES HERE
  if($a == 0) {
    if(preg_match_all('/(.*)<\/td>/', $result, $bppe1_matches)) {
      file_put_contents($a."WebScrape.txt", str_replace('&nbsp;', '', $bppe1_matches[1]));
      include('bppe1Back1.php');
    }
    echo $a . " Files Done!<br>";
  }
  else {

    if(preg_match_all('/<a name="a"><\/a>([\s\S]*)<strong><a name="94935"><\/a>/', $result, $bppe23_matches)) {
      file_put_contents($a."WebScrape.txt", str_replace('&nbsp;', '', $bppe23_matches[1]));
    }
    echo $a . " Files Done!<br>";
  }

  //COMPARE HERE

}
curl_close($ch);

?>
