<?php 
include 'core/init.php';
if (isset($_POST['read'])) {
/*
  data.php
  Prihvatanje ajax zahteva za upravljanje porudzbinom
*/
  $orders = DB::get();
  echo json_encode($orders);
}

if (isset($_POST['clear'])) {
  $myfile = fopen("order.txt", "w") or die("Unable to open file!");
  fwrite($myfile, "");
  fclose($myfile);
  echo "Orders empty!";
}

if (isset($_POST['table'])) {
  $_SESSION['table'] = $_POST['table'];
}

if (isset($_POST['get_table'])) {
  if (isset($_SESSION['table'])) {
    echo json_encode(["table"=>$_SESSION['table']]);
  } else echo json_encode(["table"=>false]);
  
}

/*$orders = explode(",",file_get_contents("order.txt"));
  print_r($orders);*/


 ?>