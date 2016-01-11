<?php
class SocketServer{
	protected $hostname = "127.0.0.1";
	protected $port = 25003;
	protected $socket;
	protected $result;
	protected $spawn;
	protected $input;
	protected $output = "test mother fucker";
	public function __construct()
	{
		set_time_limit(0);
		$this->create();
		$this->bind();
		$this->listen();
		$this->accept();
		$this->read();
		$this->write();
		$this->closeSpawn();
		$this->closeSocket();
	}
	public function create()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
	}
	public function bind()
	{
		$this->result = socket_bind($this->socket, $this->hostname, $this->port) or die("Could not bind to socket\n");
	}
	public function listen()
	{
		$this->result = socket_listen($this->socket, 3) or die("Could not set up socket listener\n");
	}
	public function accept()
	{
		$this->spawn = socket_accept($this->socket) or die("Could not accept incoming connection\n");
	}
	public function read()
	{
		$this->input = socket_read($this->spawn, 1024) or die("Could not read input\n");
		echo $this->input;
	}
	public function write()
	{
		socket_write($this->spawn, $this->output, strlen ($this->output)) or die("Could not write output\n");
	}
	public function closeSpawn()
	{
		socket_close($this->spawn);
	}
	public function closeSocket()
	{
		socket_close($this->socket);
	}
}
?>