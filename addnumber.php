<?php
    $dir = "/var/www/html/passgen/history";
    $date = $_GET['date'];
    $num = $_GET['number'];
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