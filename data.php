<?php 
if (isset($_POST['read'])) {
  $orders = explode(",",rtrim(file_get_contents("order.txt"),","));
  echo json_encode($orders);  
}

if (isset($_POST['clear'])) {
  $myfile = fopen("order.txt", "w") or die("Unable to open file!");
  fwrite($myfile, "");
  fclose($myfile);
  echo "Orders empty!";
}

/*$orders = explode(",",file_get_contents("order.txt"));
  print_r($orders);*/


 ?>