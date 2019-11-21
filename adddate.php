<?php
$dir = "/var/www/html/passgen/history";
$filename = $_GET['date'];
$number = $_GET['number'];
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
