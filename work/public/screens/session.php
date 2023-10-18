<?php 

session_start();

$raw = file_get_contents(('php://input'));
$data = json_decode($raw);

$_SESSION['threadID'] = $data;
$threadId = $_SESSION['threadID'];


echo json_encode($threadId);