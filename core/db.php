<?php 

class DB 
{

	static $conn = null;
	
	function __construct()
	{
		# code...
	}

	public static function init($db)
	{
		self::$conn = new PDO("mysql:host={$db->servername};dbname={$db->dbname}", $db->username, $db->password);
		self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	# Select
	public static function get($value='SELECT * FROM c_orders')
	{
		$stmt = self::$conn->prepare($value); 
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    foreach ($orders as $key => $value) {
    	$orders[$key]['products'] = unserialize($value['products']);
    }
    return $orders;
	}
	# Insert, update
	public static function query($value='')
	{
		$stmt = self::$conn->prepare($value); 
    $stmt->execute();
	}
	# Vraca porudzbinu trazenog stola
	public static function exists($table)	
	{
		$data = self::get("SELECT tab FROM c_orders WHERE tab = $table");
		if($data){
			return $data[0]['tab'];
		}
		return false;
	}

}
printr($config);
DB::init($config->db);
//echo $config->db->dbname;
//printr(DB::get("SELECT * FROM c_orders"));

 ?>