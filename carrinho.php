<?php
session_start();
$connect = require_once "banco/connect.php";
require_once "functions/produtos.php";
require_once "functions/carrinho.php";


// Início do arquivo PHP, onde você já tem session_start();

if (isset($_GET['acao'])) {
    // Verifica se o usuário está logado
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        echo "Você precisa estar logado para adicionar produtos ao carrinho.";
        exit; // Impede a execução de qualquer outra lógica de adição se não estiver logado
    }

    if (in_array($_GET['acao'], array('add', 'del', 'up'))) {
        if ($_GET['acao'] == 'add' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {
            addCart($_GET['id'], 1);
        }

        if ($_GET['acao'] == 'del' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {
            deleteCart($_GET['id']);
        }

        if ($_GET['acao'] == 'up') {
            if (isset($_POST['prod']) && is_array($_POST['prod'])) {
                foreach ($_POST['prod'] as $id => $qtd) {
                    updateCart($id, $qtd);
                }
            }
        }
        header('location: carrinho.php');
    }
}


$resultsCarts = getContentCart($connect);
$totalCarts  = getTotalCart($connect);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" /> -->
	<script src="js/buttonCart.js"></script>
</head>

<body>
	<div class="container">
		<div class="card mt-5">
			<div class="card-body">
				<h4 class="card-title">Carrinho</h4>
				<a href="index.php">Lista de Produtos</a>
			</div>
		</div>

		<?php if ($resultsCarts) : ?>
			<form action="carrinho.php?acao=up" method="post">
				<table class="table table-strip">
					<thead>
						<tr>
							<th>Produto</th>
							<th>Quantidade</th>
							<th>Preço</th>
							<th>Subtotal</th>
							<th>Ação</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach ($resultsCarts as $result) : ?>
							<tr>

								<td><?php echo $result['name'] ?></td>
								<td>
									<!-- <input type="text" name="prod[<?php echo $result['id'] ?>]" value="<?php echo $result['quantity'] ?>" size="1" /> -->
									<div data-product="{{ product.id }}">
										<div class="produto_qnt_princ" data-product="{{ product.id }}" data-app="product.quantity">
											<input class="qnt_menor_maior" type="button" id="plus" value='-' onclick="process_geral(-1,'{{ product.id }}')" />
											<input class="quanti qnt_menor_maior" name="prod[<?php echo $result['id'] ?>]" value="<?php echo $result['quantity'] ?>" class="text" size="1" type="text" value="1" maxlength="5" />
											<input class="qnt_menor_maior" type="button" id="minus" value='+' onclick="process_geral(1,'{{ product.id }}')" />
										</div>
									</div>

								</td>
								<td>R$<?php echo number_format($result['price'], 2, ',', '.') ?></td>
								<td>R$<?php echo number_format($result['subtotal'], 2, ',', '.') ?></td>
								<td><a href="carrinho.php?acao=del&id=<?php echo $result['id'] ?>" class="btn btn-danger">Remover</a></td>

							</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="3" class="text-right"><b>Total: </b></td>
							<td>R$<?php echo number_format($totalCarts, 2, ',', '.') ?></td>
							<td></td>
						</tr>
					</tbody>

				</table>
				<a class="btn btn-info" href="index.php">Continuar Comprando</a>
			</form>
		<?php else : ?>
			<h2>Sem produtos no carrinho</h2>
		<?php endif ?>

	</div>

</body>

</html>