<?php

namespace Form;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../vendor/autoload.php";

class SubmitForm {
    public function submit($name, $phone, $email, $ip){

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            $mail->charSet = "UTF-8"; 
            $mail->SMTPDebug  = 0; 
            $mail->isSMTP();                                           
            $mail->Host       = 'mail...'; 
            $mail->Port       = 587;                             
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = '#';                     
            $mail->Password   = '#';
            $mail->addReplyTo($email, $name);                          
            $mail->SMTPAutoTLS = true;        
            $mail->setFrom('#', 'Name');
            $mail->addAddress('#', 'Name');
            $mail->isHTML(true);
            $mail->Subject = 'Title';
            $mail->Body    = 
                "Nome: {$name} <br><br>
                 E-mail: {$email} <br><br>
                 Telefone: {$phone} <br><br>
                 Enviado a patir do IP: {$ip}
                ";
    
            $send = $mail->send();

            if($send){
                return json_encode(["message" => "success", "status" => 200]);
            }
            return json_encode(["message" => "Ocorreu um eror ao tentar enviar sua mensagem. Por favor, tente novamente mais tarde!", "status" => 500]);
    
        } catch (\Exception $e) {
            return json_encode(["message" => $mail->ErrorInfo, "status" => 500]);
        }
    }
}