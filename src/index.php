<?php
require_once "vendor/autoload.php";

use Google\Cloud\BigQuery\BigQueryClient;

$projectId = 'hja-test1';
$keyFile = '/keys/google.json';

$bigQuery = new BigQueryClient([
    'projectId' => $projectId,
    'keyFilePath' => $keyFile,
]);

$json = json_decode($_POST["mailinMsg"]);

foreach($json->attachments as $a) {
  // check on $a->fileName - > for different logic per fileName
  // like different big query table/columns and so on. 
  //

  // Get content
  // fix filename, php somehow messes thos up
  $cleanedFileName = str_replace(".", "_", $a->generatedFileName);
  $b64 = $_POST[$cleanedFileName];

  // we now have a csv
  $csvStr = base64_decode($b64);
  $rows = explode("\n", $csvStr);

  $schema = [
    ['name' => 'column1', 'type' => 'STRING'],
    ['name' => 'column2', 'type' => 'INTEGER'],
    ['name' => 'column3', 'type' => 'INTEGER'],
  ];

  
  $table = $bigQuery->dataset('test')->table('test');

  // Check if the table already exists before creating it
  if (!$table->exists()) {
    $table->create(['schema' => ['fields' => $schema]]);
  }


  $data = [
    [$rows[1][0], $rows[1][1], $rows[1][2]],
  ];

  $insertResponse = $table->insertRows($data);

  if ($insertResponse->isSuccessful()) {

    // OK
    error_log("OK");
  } else {
    // NOK
    error_log("NOK");
  }
}

