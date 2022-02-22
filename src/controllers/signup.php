<?php
loadModel('SignUp');

$exception = null;

if(count($_POST) > 0){
    try{
        $user = new User($_POST);
        SignUp::checkSignUp($user);
        $user->setRows();
        $user->insert();
        addMsgSuccess('Usuário cadastrado com sucesso!');
        $_POST = [];
    }
    catch(ValidationException $e){
        $exception = $e;
        addMsgError('Erro ao cadastrar usuário');
    }
}
else{
    $user = 0;
}

loadView('signup', $_POST + ['exception' => $exception]);