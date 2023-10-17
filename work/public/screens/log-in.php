<!-- テストコード -->
<?php 
session_start();

//データーをjsからセッションに保管
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataValue = $_POST['dataValue'];
    $_SERVER['saved_data'] =$dataValue;
    echo ($_SERVER['saved_data']);
    http_response_code(200);
  } else {
    http_response_code(400);
  }