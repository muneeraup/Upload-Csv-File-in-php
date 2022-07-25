<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config.php';
require_once __DIR__ . '/vendor/autoload.php';
$stmt = $conn->query("select * from naat_data where status='0'")->fetchAll();
//die(str_replace('%print_r%', print_r($file_data, TRUE), "<pre style='margin-top:0px;'>%print_r%</pre>"));
foreach ($stmt as $sm) {
  // $file_download= $conn->query("select * from naat_data")->fetchAll();
  /* $file_download = $conn->prepare("select json_array from naat_data where status=? i LIMIT 1");
 $file_download->execute(['0']);
$file_data = $file_download->fetch();*/
  $array = json_decode($sm['json_array']);

  $filename = basename($array->test->twelve, '.mp3');
  $audio_filename = $filename . '_' . time() . '.mp3';
  $sql = "UPDATE naat_data SET status=? ,file_name=? WHERE id=?";
  $conn->prepare($sql)->execute(['1', $audio_filename, $sm['id']]);
  $file = file_get_contents($array->test->twelve);
  $file_content = htmlentities($file);
  // die(str_replace('%print_r%', print_r(htmlentities($file), TRUE), "<pre style='margin-top:0px;'>%print_r%</pre>"));
  if (htmlentities($file)) {
    $sql = "UPDATE naat_data SET status=? WHERE id=?";
    $conn->prepare($sql)->execute(['3', $sm['id']]);
  } else {
    file_put_contents(dirname(__FILE__) . '/upload/' . $audio_filename, $file);
    $sql = "UPDATE naat_data SET status=? WHERE id=?";
    $conn->prepare($sql)->execute(['2', $sm['id']]);
  }


}
echo 'files successfully downloaded';
