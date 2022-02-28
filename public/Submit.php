<?php

namespace Publics;

use Form\VerifyForm;

require __DIR__ . "/../vendor/autoload.php";

class Submit {

    public function checkPost(){
        return $_SERVER['REQUEST_METHOD'] == "POST" ? true: false;
    }
   
    public function validating(){
        $validating = new VerifyForm;
        return $validating->validateForm();
    }

}

$form = new Submit;

echo $form->checkPost() ? $form->validating() : header("404 not found", true, 404);