<!-- Student : Abhinaya Ramachandran-->



<?php
ini_set('display_errors', 'on');

define('DB_SERVER', '127.0.0.1:3308');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'board');

$conn_string = "mysql:host=".DB_SERVER.";dbname=".DB_NAME;
$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$conn = new PDO($conn_string,DB_USERNAME, DB_PASSWORD, $opt);
if ($conn == false){
	die("Error: Could not connect ");
}

?>