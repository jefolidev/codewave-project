<?php 

if(!isset($_SESSION['carrinho'])) {
	$_SESSION['carrinho'] = array();
}

function addCart($id, $quantity = 1) {
	if(!isset($_SESSION['carrinho'][$id])){ 
		$_SESSION['carrinho'][$id] = $quantity; 
	}else{
		$_SESSION['carrinho'][$id] += $quantity; 
	}
}

function deleteCart($id) {
	if(isset($_SESSION['carrinho'][$id])){ 
		unset($_SESSION['carrinho'][$id]); 
	} 
}

function updateCart($id, $quantity) {
	if(isset($_SESSION['carrinho'][$id])){ 
		if($quantity > 0) {
			$_SESSION['carrinho'][$id] = $quantity;
		} else {
		 	deleteCart($id);
		}
	}
}

function getContentCart($connect) {
	
	$results = array();
	
	if($_SESSION['carrinho']) {
		
		$cart = $_SESSION['carrinho'];
		$products =  getProductsByIds($connect, implode(',', array_keys($cart)));

		foreach($products as $product) {

			$results[] = array(
							  'id' => $product['id_prod'],
							  'name' => $product['nome_prod'],
							  'price' => $product['preco_prod'],
							  'quantity' => $cart[$product['id_prod']],
							  'subtotal' => $cart[$product['id_prod']] * $product['preco_prod'],
						);
		}
	}
	
	return $results;
}

function getTotalCart($connect) {
	
	$total = 0;

	foreach(getContentCart($connect) as $product) {
		$total += $product['subtotal'];
	} 
	return $total;
}