<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config.php';
require_once __DIR__ . '/vendor/autoload.php';

function readXlsFile() {
  //  $spreadsheet = new Spreadsheet();
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/test.csv');
  $worksheet = $spreadsheet->getActiveSheet();
  $rows = [];
  foreach ($worksheet->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
    $cells = [];
    foreach ($cellIterator as $cell) {
      $cells[] = $cell->getValue();
    }
    $rows[] = $cells;
  }


  $tempVariable = [];
  return array_map(function ($v) {
    $filterd = array_map(function ($v, $k) {

      switch ($k) {
        /*category*/
        case 0:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
          break;
        /*job*/
        case 1:
          return /*preg_replace("/[^a-zA-Z\s]/", "", $v)*/ $v;
          break;
        /*price*/
        case 2:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
          break;
        /*cis true or false*/
        case 3:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
          break;
        case 4:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
          break;
        /*job*/
        case 5:
          return /*preg_replace("/[^a-zA-Z\s]/", "", $v)*/ $v;
          break;
        /*price*/
        case 6:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
          break;
        /*cis true or false*/
        case 7:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
          break;  
        case 8:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
          break;   
        case 9:
          return preg_replace("/[^a-zA-Z\s]/", "", $v);
            break;       
      }
    }, array_values($v), array_keys($v));
    return $filterd;
  }, array_values($rows));
}

$array = readXlsFile();
//  die(json_encode($array));
// die(str_replace('%print_r%', print_r($array, TRUE), "<pre style='margin-top:0px;'>%print_r%</pre>"));
$string = '';
if (count($array) > 0) {
  $i = 0;
  foreach ($array as $r) {
    $i++;
    if ($i == 1) continue;
    $zero    =   $r[0];
    $first   =   $r[1];
    $second  =   $r[2];
    $third   =   $r[3];
    $fourth  =   $r[4];
    $fifth   =   $r[5];
    $six     =   $r[6];
    $seven   =   $r[7];
    $eight   =   $r[8];
    $nine    =   $r[9];
    $example =   ["test" => array(

    "zero "   =>   $zero,
    "first"   =>   $first,
    "second"  =>   $second,
    "third"   =>   $third,
    "fourth"  =>   $fourth,
    "fifth"   =>   $fifth,
    "six"     =>   $six,
    "seven"   =>   $seven,
    "eight"   =>   $eight,
    "nine"    =>   $nine,

   )];
   $save = json_encode($example);
   $statement = $conn->prepare('INSERT INTO `naat_data`( `json_array`, `status`, `file_name`) VALUES ( :save,"0","mm")');
   $statement->execute([
    'save' => $save
   ]);
  //  die(str_replace('%print_r%', print_r($statement, TRUE), "<pre style='margin-top:0px;'>%print_r%</pre>"));
    $string .= '<option value="' . trim(implode('_', $r)) . '" data-value="' . trim(implode('_', $r)) . '">' . $r[1]/*.'-'.trim($r[0])*/ . '</option>' . PHP_EOL;
  }
}
return $string;


