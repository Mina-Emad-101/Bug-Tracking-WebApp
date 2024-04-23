<?php
require_once __DIR__ . '/../Controllers/dbController.php';
require_once __DIR__ . '/../Controllers/messagesController.php';
require_once __DIR__ . '/../Models/user.php';

class Message
{
	private $id;
	private $message;
	private $senderID;
	private $recieverID;
	private $sender;
	private $reciever;

	public function __construct($dbRow)
	{
		$this->id = $dbRow['id'];
		$this->message = $dbRow['message'];
		$this->senderID = $dbRow['sender_id'];
		$this->recieverID = $dbRow['reciever_id'];

		$query = 'SELECT * FROM auth WHERE id = ' . $this->senderID . ';';
		$result = DbController::query($query);
		$this->sender = new User($result->fetch_assoc());

		$query = 'SELECT * FROM auth WHERE id = ' . $this->recieverID . ';';
		$result = DbController::query($query);
		$this->reciever = new User($result->fetch_assoc());
	}

	public function getID()
	{
		return $this->id;
	}

	public function getMessage()
	{
		return $this->message;
	}

	public function getSender()
	{
		return $this->sender;
	}

	public function getReciever()
	{
		return $this->reciever;
	}
}
