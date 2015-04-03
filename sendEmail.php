<?php
	use Aws\Ses\SesClient;
	require 'vendor/autoload.php';
	require_once('config/setting.php');
	
	function sendVerifyEmail($rcvEmail, $userId){
		global $SERVER_IP, $AWS_KEY, $AWS_SECRET;
	
		$subject = "Confirm your email";
		$body = "Welcome! ".$rcvEmail."\n\n"."You have been successfully registered as a member to CP08.\n";
		$body.="Please first confirm your email address to ensure full access to CP08.\n";
		$body.="http://".$SERVER_IP."/cloud_programming/verifyEmail.php?id=".md5((string)Time()).$userId;
		
		$client = SesClient::factory(array(
				'key' => $AWS_KEY,
				'secret' => $AWS_SECRET,
				'region' => 'us-east-1'
		));

		//Now that you have the client ready, you can build the message
		$msg = array();
		$msg['Source'] = "yilin1218@gmail.com";
		//ToAddresses must be an array
		$msg['Destination']['ToAddresses'][] = "a5834929@gmail.com";

		$msg['Message']['Subject']['Data'] = $subject;
		$msg['Message']['Subject']['Charset'] = "UTF-8";

		$msg['Message']['Body']['Text']['Data'] = $body;
		$msg['Message']['Body']['Text']['Charset'] = "UTF-8";

		try{
				 $result = $client->sendEmail($msg);

				 //save the MessageId which can be used to track the request
				 $msg_id = $result->get('MessageId');
				 echo("MessageId: $msg_id");

				 //view sample output
				 print_r($result);
		} catch (Exception $e) {
				 //An error happened and the email did not get sent
				 echo($e->getMessage());
		}
		//view the original message passed to the SDK 
		//print_r($msg);
	}
?>


