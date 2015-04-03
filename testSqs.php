<?php
	use Aws\Sqs\SqsClient;
	require 'vendor/autoload.php';
	require_once('config/setting.php');
	
	$client = SqsClient::factory(array(
		'key' => $AWS_KEY,
		'secret' => $AWS_SECRET,
		'region' => 'us-east-1'
	));
	$queueUrl = "https://sqs.us-east-1.amazonaws.com/661664929584/input-cp08";
	$msg="https://us-east-1-aws-training.s3.amazonaws.com/arch-static-assets/static/20120728-DSC01265-L.jpg\n"
		 ."https://us-east-1-aws-training.s3.amazonaws.com/arch-static-assets/static/20120728-DSC01267-L.jpg\n"
		 ."https://u-east-1-aws-training.s3.amazonaws.com/arch-static-assets/static/20120728-DSC01292-L.jpg\n"
		 ."https://us-east-1-aws-training.s3.amazonaws.com/arch-static-assets/static/20120728-DSC01315-L.jpg\n"
		 ."https://us-east-1-aws-training.s3.amazonaws.com/arch-static-assets/static/20120728-DSC01337-L.jpg";
	
	$client->sendMessage(array(
		'QueueUrl'    => $queueUrl,
		'MessageBody' => $msg,
	));

?>