<?php
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9-]/', '', $string); // Removes special chars.
}
$dir = "/var/www/html/passgen/history";
$filename = $_GET['date'];
$number = $_GET['number'];
$filename = clean($filename);

if (file_exists($dir.'/'.$filename)) {
    echo "The file $filename already exists";
} else {
    if(is_numeric($number) && (int)$number < 10 && (int)$number >= 0) {
        $fp = fopen($dir."/".str_pad($filename,2,'0',STR_PAD_LEFT), "w");
        fwrite($fp,$number."\n");
        fclose($fp);
        echo "thx for your efforts<br/>$filename : '$number'";
    } else {
        echo "Bad Data!<br/>";
        echo "date : $filename<br/>";
        echo "number : $number<br/>";
    }
}
 ?>
