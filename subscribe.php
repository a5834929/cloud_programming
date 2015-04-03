<?php
	require 'vendor/autoload.php';
	use Aws\Sns\SnsClient;
	require_once('config/setting.php');
	
	$client = SnsClient::factory(array(
		'key' => $AWS_KEY,
		'secret' => $AWS_SECRET,
		'region' => 'us-east-1'
	));
	
	/*$result = $client->subscribe(array(
		// TopicArn is required
		'TopicArn' => 'arn:aws:sns:us-east-1:661664929584:Idols',
		// Protocol is required
		'Protocol' => 'email',
		'Endpoint' => 'yilin1218@gmail.com',
	));
	echo $result;*/
	
	$result = $client->listSubscriptionsByTopic(array(
		// TopicArn is required
		'TopicArn' => 'arn:aws:sns:us-east-1:661664929584:Idols',
		'NextToken' => '',
	));
	$arr=$result->get("Subscriptions");
	for($i=0;$i<count($arr);$i++){
		echo $arr[$i]["Endpoint"]."\n";
	}	
	
	
	
?>