<?php
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9-]/', '', $string); // Removes special chars.
}
    $dir = "/var/www/html/passgen/history";
    $date = $_GET['date'];
    $num = $_GET['number'];
    $date = clean($date);
    
    if(is_numeric($num)) {
        $fp = fopen($dir."/".$date, "a");
        fwrite($fp,$num."\n");
        fclose($fp);
        var_dump($num);
        echo "Success";
    } else {
        echo "Fail for some reason";
    }
    echo "<br/>";
    echo '<a href="https://mit-games.kr/passgen/getnumber.php?date='.$date.'">back</a>';
?>
