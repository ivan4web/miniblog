<?
header("HTTP/1.0 404 Not Found");header("HTTP/1.1 404 Not Found");header('Status: 404 Not Found');
$a404 = 1;
$p = "p/main.php";if(!isset($_config)){session_start();}

include("index.php");
?>
