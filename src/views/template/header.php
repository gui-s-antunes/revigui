<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/template.css">
    <link rel="stylesheet" href="assets/css/revise.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/manageRevise.css">
    <title>Document</title>
</head>
<body>
    <nav class="header">
        <div class="logo"><a href="paginaInicial.php"><i class="icofont-notebook"></i> Ravigui</a></div>
        <div class="options">
            <ul>
                
                <li><a href="createRevise.php">Criar</a></li>
                <li><a href="paginaInicial.php">Consultar</a></li>
                <li><a href="manageRevise.php">Gerenciar</a></li>
                <?php if($_SESSION['user']->is_admin):?>
                <li>
                    <a href=".php">Admin</a>
                </li>
                <?php endif ?>
            </ul>
            <!-- Fazer uma opção ADMIN para ativar contas -->
        </div>
        <div class="separador"></div>
        <div class="user-space">
            <p class="welcome-text">Bem vindo, <?= $_SESSION['user']->name ?> | <i class="icofont-gear"></i></p>
            <div class="user-options">
                <ul>
                    <!-- <li><a href=".php">Conta</a></li>  Alterar nome, senha e desativar conta -->
                    <li><a href="logout.php"><i class="icofont-exit"></i> Sair</a></li> <!-- Fazer logout -->
                </ul>
            </div>
        </div>
    </nav>