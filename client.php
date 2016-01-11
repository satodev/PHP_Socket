<?php
class SocketClient{
	protected $host    = "127.0.0.1";
	protected $port    = 25003;
	protected $socket;
	protected $result;
	public function __construct()
	{
		$this->create();
		$this->connect();
		$this->write('hello server, how are you ?');
		$this->read();
		$this->showResult();
		$this->close();
	}
	public function create()
	{
		$this->socket = socket_create(AF_INET,SOCK_STREAM, 0) or die('Could not create socket\n');
	}
	public function connect()
	{
		$this->result = socket_connect($this->socket, $this->host, $this->port) or die('Could not connect to server');
	}
	public function write($message)
	{
		socket_write($this->socket, $message, strlen($message)) or die("Could not send data to server\n");
	}
	public function read()
	{
		$this->result = socket_read($this->socket, 1024) or die('Could not read server response\n');
	}
	public function showResult()
	{
		echo $this->result;
	}
	public function close()
	{
		socket_close($this->socket);
	}
}
$a = new SocketClient();
?>