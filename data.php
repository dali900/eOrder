<?php 
session_start();
include 'db.php';


if (isset($_POST['read'])) {
  /*$orders = explode(",",rtrim(file_get_contents("order.txt"),","));
  echo json_encode($orders); */ 
  /*$orders = [];
  if ($file = fopen("order.txt", "r")) {
	    while(!feof($file)) {
	        $line = fgets($file);
	        $orders[] = unserialize($line);
	    }
	    fclose($file);
	    echo json_encode($orders);
	}*/
  echo json_encode(DB::get("SELECT * FROM c_orders"));
}

if (isset($_POST['clear'])) {
  /*$myfile = fopen("order.txt", "w") or die("Unable to open file!");
  fwrite($myfile, "");
  fclose($myfile);
  echo "Orders empty!";*/
  $table = $_POST['table'];
  DB::query("DELETE FROM c_orders WHERE tab = $table");
  echo "Table [$table] order deleted!";
}

/*$orders = explode(",",file_get_contents("order.txt"));
  print_r($orders);*/
if (isset($_POST['table'])) {
  $_SESSION['table'] = $_POST['table'];
}

if (isset($_POST['get_table'])) {
  if (isset($_SESSION['table'])) {
    echo json_encode(["table"=>$_SESSION['table']]);
  } else echo json_encode(["table"=>false]);
  
}

 ?>