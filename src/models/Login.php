<?php

class Login extends Model {

    private function validate(){
        $errors = [];

        if(!$this->email){
            $errors['email'] = 'O email deve ser preenchido!';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email inválido!';
        }

        if(!$this->password){
            $errors['password'] = 'A senha deve ser preenchida!';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
    
    public function checkLogin(){
        $this->validate();
        $user = User::getOne(['email' => $this->email]);
        if($user){
            if(password_verify($this->password, $user->password)){
                return $user;
            }
        }
        throw new ValidationException([], 'Email e/ou senha inválido(s).');
    }

}