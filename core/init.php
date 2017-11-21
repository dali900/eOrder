<?php 
# Helpers
function printr($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

# Load config file
$config_file = include ('config.php');
# Convert array to object
$config = json_decode(json_encode($config_file), FALSE);
include 'db.php';
error_reporting($config->error_reporting);

 ?>