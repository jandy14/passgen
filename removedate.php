<?php
$dir = "/var/www/html/passgen/history";
$dst = "/var/www/html/passgen/archive";
$filename = $_GET['date'];

if(file_exists($dir.'/'.$filename) && $filename != "") {
    $index = 0;
    while(true) {
        if(file_exists($dst.'/'.$filename.'_'.$index)) {
            $index += 1;
        } else {
            rename($dir.'/'.$filename, $dst.'/'.$filename.'_'.$index);
            break;
        }
    }
    echo "The file $filename is successfully removed";
} else {
    echo "The file $filename doesn't exist";
}
 ?>
