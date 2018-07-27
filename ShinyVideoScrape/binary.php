<?php
//WORKS BUT ONLY WUTH CHARACTERS UNDER A CERTAIN SIZE
$string = unpack('H*', "Better33");
echo base_convert($string[1], 16, 2) . "<br />";
echo pack('H*', base_convert('10000100110010101110100011101000110010101110010', 2, 16)) . "<br />";
echo pack('H*', base_convert(base_convert($string[1], 16, 2), 2, 16)) . "<br />";
echo base64_encode("Better33") . "Titties<br />";


//Convert a string value from binary to hex and back: VERY LONG STRINGS!!!
$str = "How well will this one work? Holy SHIT please keep matching all of my shiz!";
echo bin2hex($str) . "<br>";
echo pack("H*",bin2hex($str)) . "<br>";
echo hex2bin("486f772077656c6c2077696c6c2074686973206f6e6520776f726b3f20486f6c79205348495420706c65617365206b656570206d61746368696e6720616c6c206f66206d79207368697a21") . "<br />";


//Convert decimal to binary:
echo decbin("3") . "<br>";
echo decbin("1") . "<br>";
echo decbin("1587") . "<br>";


//WILL OUTPUT:  VGhpcyBpcyBhbiBlbmNvZGVkIHN0cmluZw==
$str = 'This is an encoded string';
echo base64_encode($str) . "<br>";

//THIS WILL OUTPUT:  This is an encoded string
$str = 'VGhpcyBpcyBhbiBlbmNvZGVkIHN0cmluZw==';
echo base64_decode($str) . "<br>";


//MATCHES BINARY
function is_base64_encoded()
    {
        if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    };

is_base64_encoded("iash21iawhdj98UH3"); // true
is_base64_encoded("#iu3498r"); // false
is_base64_encoded("asiudfh9w=8uihf"); // false
is_base64_encoded("a398UIhnj43f/1!+sadfh3w84hduihhjw=="); // true



//ord — Return ASCII value of charact
$str = "\n";
if (ord($str) == 10) {
    echo "The first character of \$str is a line feed.\n";
}
?>
