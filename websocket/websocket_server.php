<?php
require_once '../vendor/autoload.php';
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

use Ratchet\Http\OriginCheck;

class Chat implements MessageComponentInterface {
	protected $clients;
	protected $users;

	public function __construct() {
		# SplObjectStorage - objekat koji cuva druge ubjekte u sebi kao niz
		# SplObjectStorage Object ['object_Id'=>object1, 'object_Id'=>object2 ...]
		$this->clients = new \SplObjectStorage;
	}
	# Uspostavljanje konekcije sa klijentom
	public function onOpen(ConnectionInterface $conn) {
		$conn->id = "";
		$this->clients->attach($conn);
		echo "CONNECTED {{$conn->resourceId}} \n" ;
		//$this->users[$conn->resourceId] = $conn;
	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		echo "User {{$conn->resourceId}} left the room \n";
		// unset($this->users[$conn->resourceId]);
	}
	# Prijem podataka od klijenta
	public function onMessage(ConnectionInterface $from,  $data) {
		$from_id = $from->resourceId; # Trenutni klijent ID
		$data = json_decode($data); # $data - podaci poslati od klijenta
		$type = $data->type;
		# Ukoliko je klijent poslao svoj ID kao zaposleni, tom $client objektu dodajemo nov property 'id'
		if (isset($data->user_id) && $data->user_id == "STUFF") {
			foreach ($this->clients as $client) {
				// $from (klijent koji salje poruku) Slanje poruke svim registrovanim klijentima osim samom sebi
				if ($from == $client) { 
					$client->id = "STUFF";
				}
			}		
			echo "STUFF logged in \n";
		}
		switch ($type) {
			# Saljemo sanku porudzbinu 
			case 'order':
				$product = $data->product;
				echo "$product \n";
				// Output
				//$from->send(json_encode(array("type"=>$type,"product"=>$product)));
				foreach ($this->clients as $client) {
					if ($client->id == "STUFF") {
						# Salnje porudzbine
						$client->send(json_encode(array("type"=>$type,"product"=>$product,"table"=>$data->table)));
					}
				}
				break;
			# Sanke salje poruku klijentu (trenutno salje svim klijentima)
			case 'ordering_status':
				foreach($this->clients as $client)
				{
					if($from!=$client) 
					{
						$client->send(json_encode(array("type"=>$type,"comming"=>$data->comming,"msg"=>$data->msg)));
					}
				}
				break;
		}
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		$conn->close();
	}
}


$server = IoServer::factory(
	new HttpServer(
		new WsServer(
			new Chat()
		)
	),
	8080
);

$server->run();

/*$app = new Ratchet\App('192.168.0.107', 8181, '0.0.0.0');
$app->route('/', new Chat(), ['*']);
$app->run();*/
?>