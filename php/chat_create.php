<?php
// var_dump($_POST);
// exit();

date_default_timezone_set('Asia/Tokyo');

$name = $_POST['name'];
$text = $_POST['text'];
$timestamp = time();
$time = date('H:i', $timestamp);

if (!empty($text)) {
  $write_data = "{$name},{$text},{$time}\n";

  $datafile = fopen('../data/chatdata.csv', 'a');
  flock($datafile, LOCK_EX);

  fwrite($datafile, $write_data);

  flock($datafile, LOCK_UN);
  fclose($datafile);
}

header("Location:../index.php");
