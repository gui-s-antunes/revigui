<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
</head>
<body>
    <div class="login-div">
        <?php require_once(VIEW_TEMPLATE_PATH . '/messages.php')?>
        <h1>Criação de novo usuário</h1>
        <form class="login-form" action="#" method="post">
            <div class="input-group">
                <div class="form-input <?= $error['email'] ? 'error-input' : '' ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Insira o email" value="<?= isset($email) ? $email : '' ?>">
                </div>
                <div class="form-error">
                    <?= $error['email'] ? $error['email'] : '' ?>
                </div>
            </div>
            <div class="input-group">
                <div class="form-input <?= $error['name'] ? 'error-input' : '' ?>">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="Insira o nome" value="<?= isset($name) ? $name : '' ?>">
                </div>
                <div class="form-error">
                    <?= $error['name'] ? $error['name'] : '' ?>
                </div>
            </div>
            <div class="input-group">
                <div class="form-input <?= $error['password'] ? 'error-input' : '' ?>">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" placeholder="Insira a senha">
                </div>
                <div class="form-error">
                    <?= $error['password'] ? $error['password'] : '' ?>
                </div>
            </div>
            <div class="input-group">
                <div class="form-input <?= $error['confirm_password'] ? 'error-input' : '' ?>">
                    <label for="password">Confirmar Senha</label>
                    <input type="password" name="confirm_password" id="password" placeholder="Insira a senha novamente">
                </div>
                <div class="form-error">
                    <?= $error['confirm_password'] ? $error['confirm_password'] : '' ?>
                </div>
            </div>
            <button class="login-btn">Criar Conta</button>
        </form>
        <a class="signup-link" href="login.php">Fazer login conta existente</a>
    </div>
</body>
</html>