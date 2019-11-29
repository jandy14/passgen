<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Password Generator</title>
  </head>
  <body>
<?php
$dir = "/var/www/html/passgen/archive";

// 핸들 획득
$handle  = opendir($dir);

$files = [];
// 디렉터리에 포함된 파일을 저장한다.
while (false !== ($filename = readdir($handle))) {
    if($filename == "." || $filename == ".."){
        continue;
    }
    // 파일인 경우만 목록에 추가한다.
    if(is_file($dir . "/" . $filename)){
      $files[$filename] = [];
      $fp = fopen($dir."/".$filename, "r");
      while( !feof($fp) ) {
        $data = preg_replace('/\s+/', '', fgets($fp));
        if(is_numeric($data)) {
          array_push($files[$filename],(int)$data);
        }
      }
      fclose($fp);
    }
}
// 핸들 해제
closedir($handle);
ksort($files);
 ?>
    <h2>컴퓨터께서 행운의 숫자를 주실지니!!</h2>
<div class="mb-4">
    <button id="backbutton" type="button" class="btn btn-primary">Back</button>
    <script type="text/javascript">
    document.getElementById("backbutton").onclick = function () {
        location.href = "https://mit-games.kr/passgen/index.php";
    };
    </script>
</div>
<div class="mb-2">
<?php
$filecount = count($files);
$numbercount = [];
$totalcount = 0;
$totalpercent = 1;
foreach ($files as $k => $v) {
    $tmp = array_slice($v, 1);
    $numbercount[$k] = count($tmp);
    $totalcount += $numbercount[$k];
}
foreach ($numbercount as $k => $v) {
    $totalpercent *= (1 - $v / 1000);
}
echo "우리는 지금까지 $filecount 일 동안 $totalcount 개의 숫자를 확인했다.<br/>";
$tmp = round((1 - $totalpercent) * 100, 2);
echo "우리의 지금까지의 당첨 확률은 $tmp %였다.<br/>";
$tmp = round($tmp / 5);
echo "이는 우리의 모든 노력이 20면체 주사위를 딱 '한 번' 던져서 $tmp 이하가 나올 확률과 비슷하다는 의미이다.<br/>";
 ?>
</div>

<?php
echo '<nav>';
echo '<div class="nav nav-tabs" id="nav-tab" role="tablist">';
$index = 0;
foreach ($files as $k => $v) {
  if($index == 0){
    echo '<a class="nav-item nav-link active"  data-toggle="tab" href="#nav-'.$k.'" role="tab" aria-selected="true">'.$k.'</a>';
  } else {
    echo '<a class="nav-item nav-link"  data-toggle="tab" href="#nav-'.$k.'" role="tab" aria-selected="true">'.$k.'</a>';
  }
  $index += 1;
}
echo '</div>';
echo '</nav>';
echo '<div class="tab-content" id="nav-tabContent">';
$index = 0;
foreach ($files as $k => $v) {
  if($index == 0) {
    echo '<div class="tab-pane fade show active" id="nav-'.$k.'" role="tabpanel">';
  } else {
    echo '<div class="tab-pane fade" id="nav-'.$k.'" role="tabpanel">';
  }
  echo '<br/>';
  $tmp = array_slice($v, 1);
  $count = count($tmp);
  echo "우리는 이 날 $count 개의 숫자를 확인했다.<br/>";
  echo "밑은 우리에게 스러져간 숫자들의 명단이다.<br/>";
  sort($tmp);
  foreach($tmp as $data) {
    echo str_pad((string)$data,4,'0',STR_PAD_LEFT);
    echo '<br/>';
  }
  echo'</div>';
  $index += 1;
}
echo '</div>';
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="func.js"></script>
  </body>
</html>
