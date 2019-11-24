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
    if(is_numeric($number)) {
        $fp = fopen($dir."/".str_pad($filename,2,'0',STR_PAD_LEFT), "a");
        fwrite($fp,$number."\n");
        fclose($fp);
        echo "The number $number is added to $filename";
    } else {
        echo "$number is not a number";
    }
} else {
    echo "The file $filename doesn't exist";
}
 ?>
