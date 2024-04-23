<?php
require_once __DIR__.'/../Controllers/dbController.php';
require_once __DIR__.'/../Models/message.php';

class MessagesController
{
	public static function addMessage($message, $senderID, $recieverID)
	{
		$query = "INSERT INTO messages (message, sender_id, reciever_id) VALUES ('$message', '$senderID', '$recieverID');";
		DbController::query($query);
	}

	public static function deleteMessage($id)
	{
		$query = "DELETE FROM messages WHERE id = '$id';";
		DbController::query($query);
	}

	public static function getMessagesArray($senderID, $recieverID)
	{
		$messages = array();

		$query = "SELECT * FROM messages WHERE sender_id = '$senderID' AND reciever_id = $recieverID;";
		$result = DbController::query($query);
		while($row = $result->fetch_assoc())
		{
			$message = new Message($row);
			array_push($messages, $message);
		}

		return $messages;
	}
}

?>
