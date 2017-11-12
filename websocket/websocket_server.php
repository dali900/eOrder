<?php
require_once '../vendor/autoload.php';
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface {
	protected $clients;
	protected $users;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
	}

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

	public function onMessage(ConnectionInterface $from,  $data) {
		$from_id = $from->resourceId;
		$data = json_decode($data);
		$type = $data->type;
		if (isset($data->user_id) && $data->user_id == "STUFF") {
			foreach ($this->clients as $client) {
				if ($from == $client) {
					$client->id = "STUFF";
				}
			}
			
			echo "STUFF logged in \n";
		}
		switch ($type) {
			case 'order':
				$product = $data->product;
				echo "$product \n";
				// Output
				//$from->send(json_encode(array("type"=>$type,"product"=>$product)));
				foreach ($this->clients as $client) {
					if ($client->id == "STUFF") {
						$client->send(json_encode(array("type"=>$type,"product"=>$product)));
					}
				}
				break;

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
	new HttpServer(new WsServer(new Chat())),
	8080
);
$server->run();
?>