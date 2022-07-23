<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config.php';
require_once __DIR__ . '/vendor/autoload.php';
$stmt = $conn->query("select * from naat_data")->fetchAll();
//$blog_meta_data = $stmt->fetchAll();
//die(str_replace('%print_r%', print_r($stmt, TRUE), "<pre style='margin-top:0px;'>%print_r%</pre>"));
foreach($stmt as $sm){
    $array = json_decode($sm['json_array']);
    $file =file_get_contents($array->test->fifth);
 /*$ch = curl_init('https://www.naataudio.com/UserFiles/1648477352/audio1648495099.mp3');
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_NOBODY, 0);
 curl_setopt($ch, CURLOPT_TIMEOUT, 5);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
 $output = curl_exec($ch);
 $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 curl_close($ch);
 if ($status == 200) {
     file_put_contents(dirname(__FILE__) . '/audio.mp3', $output);
 }*/
 file_put_contents(dirname(__FILE__) . '/audio1648495099.mp3', fopen('https://www.naataudio.com/downloads/SyedIjazShahKazmiRawalpindi/Mujhe Zindgi Mai Ya Rab Urdu Hamd by Syed Ijaz Kazmi.mp3', 'r'));
    die(str_replace('%print_r%', print_r($file, TRUE), "<pre style='margin-top:0px;'>%print_r%</pre>"));
}
