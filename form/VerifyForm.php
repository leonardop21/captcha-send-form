<?php

namespace Form;

use Captcha\Captcha;

require __DIR__ . "/../vendor/autoload.php";

class VerifyForm {

    protected $name;
    protected $phone;
    protected $email;
    protected $g_recaptcha_response;

    public function __construct()
    {
        $this->name;
        $this->phone;
        $this->email;
        $this->g_recaptcha_response;
    }
    
    public function validateForm(){
        // Checa se os campos foram preenchidos, captcha e e-mails válidos
        $valid = $this->validateField();
        $validCaptcha = $this->validateCaptcha();
        $validateEmail = $this->validateEmail($this->email);

        if($valid && $validCaptcha && $validateEmail){
            // Instância o envio
            $submit = new SubmitForm();
            $result = $submit->submit($this->name, $this->phone, $this->email, $this->getIp());
            return $result;
        }elseif(!$valid){
            return $this->message("Campos marcados com * são obrigatórios", 401);
        }elseif(!$validateEmail){
            return $this->message("Insira um e-mail válido", 401);
        }
        else {
            return $this->message("Detectamos uma tentativa incomum de contato. Por favor, tente novamente mais tarde!", 403);
        }
       
    }

    public function validateField(){
        if(!empty($_POST['g_recaptcha_response'])){
            $this->g_recaptcha_response = $_POST['g_recaptcha_response'];
        }else {
            $this->g_recaptcha_response = false;
        }
        // Checa se os campos foram preenchidos
        if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email'])){
            $this->name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
            $this->phone = htmlentities($_POST['phone'], ENT_QUOTES, 'UTF-8');
            $this->email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
            return true;
        }
        return false;
    }

    public function validateCaptcha(){
        // Checa se o captcha é valido
        $tokenRecaptcha = $this->g_recaptcha_response;
        $captcha = new Captcha;
        $result = $captcha->getCaptcha($tokenRecaptcha, $this->getIp());
        return $result == true ? true  : false;
    }

    public function message($message, $status){
        return json_encode(
            ['message' => $message,
             'status' => $status
            ]
        );
    }

    public function validateEmail($email){
        // Checa se o e-mail é válido
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function getIp(){
        // Pega o ip do usuário
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];
    
        if(filter_var($client, FILTER_VALIDATE_IP)){
          $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)){
          $ip = $forward;
        }
        else{
          $ip = $remote;
        }
        return $ip;
    }
}