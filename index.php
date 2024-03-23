<?php
session_start(); // Inicia a sessão PHP no início do script
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Principal</title>
</head>
<body>
    <h1>Seja bem-vindo à tela principal</h1>
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        
        <a href="produtos.php"><button>Produtos</button></a>
        <a href="functions/sair.php"><button>Sair da conta</button></a>
    <?php else: ?>
        <h1>Por favor, faça o login</h1>
        <a href="produtos.php"><button>Produtos</button></a>
        <a href="functions/init-oauth.php"><button>Logar com Discord</button></a>
    <?php endif; ?>
</body>
</html>
