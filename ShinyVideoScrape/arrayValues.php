
<?php
echo bin2hex("in") . "<br />";
echo pack("H*", bin2hex("in")) . "<br />";
$input = bin2hex("in");

//	BTOB 비투비 (Official YouTube Channel)
$artistName = bin2hex("Berry Good");
$channelName = bin2hex("United CUBE (CUBE Entertainment Official YouTube C");
$songName = bin2hex("Into The New World");
$videoDesc = bin2hex("Official Music Video");
$youtubeLink = bin2hex("https://www.youtube.com/watch?v=a1ENnG-s630");

if(strpos($artistName, $input) || strpos($channelName, $input) || strpos($songName, $input) || strpos($videoDesc, $input) || strpos($youtubeLink, $input) === true) {
  echo "THE TITTIES ARE REAL1<br />";
}

else {
  echo "Thinks money is everything!";
}


/*
$line = "Vi is the greatest word processor ever created!";
// perform a case-Insensitive search for the word "Vi"

if (preg_match("/\bVi\b/i", $line, $match)) :
   print "Match found!";
   endif;
*/
?>
