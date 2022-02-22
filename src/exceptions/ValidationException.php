<?php

class ValidationException extends Exception {
    private $errors = [];

    public function __construct($errors = [], $message = 'Erro ao validar', $code = 0, $previous = null){
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;        
    }

    public function getErrors(){
        return $this->errors;
    }
}