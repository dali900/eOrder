<?php 
session_start();
include 'core/init.php';
/*
	data.php
	Prihvatanje ajax zahteva za upravljanje sa porudzbinom
 */

# Ucitavanje porudzbine iz baze
if (isset($_POST['read'])) {
  echo json_encode(DB::get());
}

# Upis porudzibne 
if (isset($_POST['order'])) {
  $product = $_POST['order'];
  $table = $_POST['table'];
  # Update postojece porudzbine ukoliko je odredjeni sto ($table) vec porucio nesto
  if (DB::exists($table)) {
    $products = DB::get("SELECT * FROM c_orders where tab = $table")[0]['products'];
    $products[] = ["name"=>$product, "quantity"=>1, "price"=>"?"];
    $products_serialized = serialize($products);
    DB::query("UPDATE c_orders SET products = '$products_serialized' WHERE tab = $table");
    echo "Table [$table] order updated";
  } else { # Upis prve porudzbine
    $products[] = ["name"=>$product, "quantity"=>1, "price"=>"?"];
    $products_serialized = serialize($products);
    DB::query("INSERT INTO c_orders (tab,products) VALUES ($table,'$products_serialized,')");
    echo "New [$table] table order saved!";
  }
  //
  die();
}

# Brisanje
if (isset($_POST['clear'])) {
  $table = $_POST['table'];
  DB::query("DELETE FROM c_orders WHERE tab = $table");
  echo "Table [$table] order deleted!";
}

if (isset($_POST['table'])) {
  $_SESSION['table'] = $_POST['table'];
}

if (isset($_POST['get_table'])) {
  if (isset($_SESSION['table'])) {
    echo json_encode(["table"=>$_SESSION['table']]);
  } else echo json_encode(["table"=>false]);
  
}

 ?>