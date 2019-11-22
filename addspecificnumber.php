<?php
$dir = "/var/www/html/passgen/history";
$filename = $_GET['date'];
$number = $_GET['number'];
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
