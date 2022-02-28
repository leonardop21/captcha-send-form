<?php

namespace Captcha;

use GuzzleHttp\Client;

require __DIR__ . "/../vendor/autoload.php";

class Captcha {
    public function getCaptcha($tokenRecaptcha, $ip)
    {
        $client = new Client();
        $privateKey = "your_private_key";
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => $privateKey,
                'response' => $tokenRecaptcha,
                'remoteip' => $ip
            ],
        ]);

        $result = json_decode($response->getBody(), true);
       return $this->validateCaptcha($result);
    }

    public function validateCaptcha($result){
        $minimun_score = 0.6;
        if($result['success'] == true && $result['score'] > $minimun_score){
            return true;
        }
        return false;
    }
}