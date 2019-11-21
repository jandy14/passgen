<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <p>
    <?php
    $dir = "/var/www/html/passgen/history";
    $filename = $_GET['date'];
    $number = 0;
    $numbers = [];
    $fp = fopen($dir."/".$filename, "r");
    $number = (int)preg_replace('/\s+/', '', fgets($fp));

      while( !feof($fp) ) {
        $data = preg_replace('/\s+/', '', fgets($fp));
        if(is_numeric($data)) {
          array_push($numbers,(int)$data);
        }
      }
    fclose($fp);
    $result = 0;
    // var_dump($numbers);
    while(true) {
        $result = mt_rand(0,999) * 10 + $number;
        if(!in_array($result, $numbers)) {
            break;
        }
        echo ".";
    }
    $result = str_pad((string)$result,4,'0',STR_PAD_LEFT);
    echo $result;
    ?>
        </p>
    </div>
    <button class="btn btn-primary" value="Refresh Page" onClick="window.location.reload();">
    I want to get another
    </button>
    <?php
    echo '<a href="./addnumber.php?date='.$_GET['date'].'&number='.$result.'" class="btn btn-success" role="button">Commit this number!</a>';
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
