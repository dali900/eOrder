<?php 
# Load config file
$config_file = include ('config.php');
# Convert array to object
$config = json_decode(json_encode($config_file), FALSE);
include 'db.php';


error_reporting($config->error_reporting);

# Helpers
function printr($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

/*$products = [
		["name"=>"Beer","quantity"=>2,"price"=> 200],
		["name"=>"Vine", "quantity"=>1, "price"=> 250],
		["name"=>"Pasta", "quantity"=>1, "price"=>650]
];

$order = serialize($products);

echo $order,"<br>";

printr(DB::get());

echo DB::get()[1]['products'][3]['name'];*/
 ?>