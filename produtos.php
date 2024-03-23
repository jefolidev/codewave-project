<?php
$connect = require_once "banco/connect.php";
require_once "functions/produtos.php";
$produtos = getProducts($connect);
session_start();

if (!$_SESSION['logged_in']) {
	header('Location: error.php');
	exit();
}
extract($_SESSION['userData']);

$avatar_url = "https://cdn.discordapp.com/avatars/$discord_id/$avatar.jpg";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title>Carrinho de Compras</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" /> -->
</head>

<body>
	<div class="container">
		<div class="row">
			<?php foreach ($produtos as $product) : ?>
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?php echo $product['nome_prod'] ?></h4>
							<h6 class="card-subtitle mb-2 text-muted">
								R$<?php echo number_format($product['preco_prod'], 2, ',', '.') ?>
							</h6>

							<a class="btn btn-primary" href="carrinho.php?acao=add&id=<?php echo $product['id_prod'] ?>" class="card-link">Comprar</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

</body>

</html>