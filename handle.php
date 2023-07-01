<?php
// Check that the request is using HTTPS
// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
//   header('HTTP/1.1 403 Forbidden');
//   exit('HTTPS is required');
// }

// Check that the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('HTTP/1.1 405 Method Not Allowed');
  echo $_SERVER['REQUEST_METHOD'].'<br/>';
  exit('POST method is required');
}


$data = file_get_contents('php://input');
date_default_timezone_set('Asia/Bangkok');
$date = date('d-m-H-i-s');


if (!isset($_GET['deviceID'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo 'Invalid credentials';
    exit;
}
$deviceID = $_GET['deviceID'];
$dir_name = "RawData/{$_GET['deviceID']}";
if (!file_exists($dir_name)) {
    mkdir($dir_name);
}


$file = "{$dir_name}/{$date}.txt";
if (file_put_contents($file, $data, FILE_APPEND) === false) {
  header('HTTP/1.1 500 Internal Server Error');
  exit('Failed to save data to file');
}


header('HTTP/1.1 200 OK');
echo 'Data saved to file';



// $dir_path = "{$dir_name}/";
// $file_count = 0;
// if ($handle = opendir($dir_path)) {
//     while (($file = readdir($handle)) !== false) {
//         if (!in_array($file, array('.', '..')) && !is_dir($dir_path.$file)) {
//             $file_count++;
//         }
//     }
//     closedir($handle);
// }
// echo $file_count;

// if ($file_count > 3){
//   // $command = "python test.py {$deviceID} > /dev/null 2>&1 &";
//   // $command = "python test.py $deviceID > /dev/null 2>&1 &";
//   $command = "start /b python process.py $deviceID";
//   // $command = "python process.py $deviceID";
//   // $command = "nohup python test.py $deviceID";
//   // popen($command, 'r');
//   // exec($command);
//   // shell_exec($command);
//   pclose(popen($command, 'r'));
// }


?>