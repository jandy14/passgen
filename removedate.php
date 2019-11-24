<?php
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9-]/', '', $string); // Removes special chars.
}
$dir = "/var/www/html/passgen/history";
$dst = "/var/www/html/passgen/archive";
$filename = $_GET['date'];
$filename = clean($filename);
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
