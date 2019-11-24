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
    <h2>컴퓨터께서 행운의 숫자를 주실지니!!</h2>
<div class="mb-4">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add date</button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSpecificNumberModal">Add Specific Number</button>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeDateModal">Remove Date</button>
</div>
<div class="mb-2">
    우리가 매일 30개의 숫자를 확인한다면 3일만에 약 10%의 숫자를 확인할 수 있다.<br/>
    그리고 그건 굉장한 것이다.
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="contact_form" action="./adddate.php" method="GET">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date</label>
            <input type="text" name="date" class="form-control">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Number</label>
            <input type="number" name="number" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  id="submitForm" class="btn btn-primary">Add New Date</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addSpecificNumberModal" tabindex="-1" role="dialog" aria-labelledby="addSpecificNumberModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Specific Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_specific_number_form" action="./addspecificnumber.php" method="GET">
          <div class="form-group">
              <label for="date-name" class="col-form-label">Date to add</label>
              <input type="text" name="date" class="form-control">
              <label for="date-name" class="col-form-label">Number to add</label>
              <input type="number" name="number" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="submitAddSpecificNumber" class="btn btn-success">Add Number</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="removeDateModal" tabindex="-1" role="dialog" aria-labelledby="removeDateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="remove_date_form" action="./removedate.php" method="GET">
          <div class="form-group">
            <label for="date-name" class="col-form-label">Date to remove</label>
            <input type="text" name="date" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="submitRemoveDate" class="btn btn-danger">Remove Date</button>
      </div>
    </div>
  </div>
</div>

<?php
$dir = "/var/www/html/passgen/history";

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
  echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" data-whatever="'.$k.'">';
  echo 'Get '.$k.'th date number!';
  echo '</button>';
  echo '<br/>';
  $tmp = array_slice($v, 1);
  $count = count($tmp);
  echo "우리는 이미 $count 개의 숫자를 확인했다.<br/>";
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
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Get your lucky number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe width="100%" height="100%" frameBorder="0" src="https://mit-games.kr/passgen/getnumber.php">
        </iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="func.js"></script>
  </body>
</html>
