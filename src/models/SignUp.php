<?php

class SignUp{
    public static function checkSignUp($user){
        $errors = [];

        if(!$user->email){
            $errors['email'] = 'Email deve ser preenchido';
        }

        if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email inválido';
        }

        if(SignUp::userExists($user)){
            $errors['email'] = 'Este email já foi cadastrado';
        }

        if(!$user->name){
            $errors['name'] = 'O nome deve ser preenchido';
        }

        if(strlen($user->name) < 2){
            $errors['name'] = 'O nome deve ter pelo menos dois caracteres';
        }

        if(strlen($user->password) < 4){
            $errors['password'] = 'A senha deve ter pelo menos 4 caracteres';
        }

        if(strlen($user->confirm_password) < 4){
            $errors['confirm_password'] = 'A confirmar senha deve ter pelo menos 4 caracteres';
        }

        if(!$user->password || !$user->confirm_password){
            $errors['password'] = 'A senha deve ser preenchida';
            $errors['confirm_password'] = 'A confirmar senha deve ser preenchida';

        }

        if($user->password !== $user->confirm_password){
            $errors['password'] = 'A senha não bate com a confirmação';
            $errors['confirm_password'] = 'A senha não bate com a confirmação';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    private static function userExists($user){
        return !!User::getOne(['email' => $user->email]);
    }
}