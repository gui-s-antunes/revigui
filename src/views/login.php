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
        <h1>Login de usuário</h1>
        <form class="login-form" action="#" method="post">
            <div class="input-group">
                <div class="form-input <?= $error['email'] ? 'error-input' : '' ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Insire o email" value="<?= isset($email) ? $email : '' ?>">
                </div>
                <div class="form-error">
                    <?= $error['email'] ? $error['email'] : '' ?>
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
            <button class="login-btn">Entrar</button>
        </form>
        <a class="signup-link" href="signup.php">Criar conta</a>
    </div>
</body>
</html>