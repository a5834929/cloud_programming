<?php
        use Aws\Ses\SesClient;
        require 'vendor/autoload.php';
        require_once('util/ses.php');

        $client = SesClient::factory(array(
                'key' => 'AKIAI6ZOUKAMYYMZDFAQ',
                'secret' => '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',
                'region' => 'us-east-1'
        ));

        //Now that you have the client ready, you can build the message
        $msg = array();
        $msg['Source'] = "yilin1218@gmail.com";
        //ToAddresses must be an array
        $msg['Destination']['ToAddresses'][] = "yilin1218@gmail.com";

        $msg['Message']['Subject']['Data'] = "Text only subject";
        $msg['Message']['Subject']['Charset'] = "UTF-8";

        $msg['Message']['Body']['Text']['Data'] ="Text data of email";
        $msg['Message']['Body']['Text']['Charset'] = "UTF-8";
        $msg['Message']['Body']['Html']['Data'] ="HTML Data of email<br />";
        $msg['Message']['Body']['Html']['Charset'] = "UTF-8";

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
        print_r($msg);

?>


