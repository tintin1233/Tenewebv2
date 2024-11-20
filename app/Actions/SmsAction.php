<?php


namespace App\Actions;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Twilio\Rest\Client;

class SmsAction {

    public function send(string $message, string $receiverNumber) {

        $sid = env('TWILIO_SID');

        $token = env('TWILIO_TOKEN');

        $fromNumber = env('TWILIO_FROM');

        try{

            $client = new Client($sid, $token);

            $client->messages->create($receiverNumber,[
                'from' => $fromNumber,
                'body' => $message
            ]);



            return 'Message Sent';
        }
        catch(Exception $e) {


            return 'Error - ' . $e->getMessage();

        }

    }
}
