<?php
require_once __DIR__.'/../../../../Controllers/messagesController.php';

session_start();

header('location:'.$_SERVER['HTTP_REFERER']);

$_SESSION['message_errors'] = array();

$conn = DbController::openConnection();

$message = mysqli_real_escape_string($conn, $_POST['message']);
$senderID = $_POST['senderID'];
$recieverID = $_POST['recieverID'];
$bugID = $_POST['bugID'];

$conn->close();

if(!$message){ array_push($_SESSION['message_errors'], "Message Can't Be Empty"); }

if(count($_SESSION['message_errors']) > 0) exit();

if(count($_SESSION['message_errors']) == 0){
	MessagesController::addMessage($message, $senderID, $recieverID, $bugID);
	$_SESSION['message_success'] = true;
}
?>
