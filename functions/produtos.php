<?php 

function getProducts($connect){
    $sql = "SELECT * FROM produtos";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Retorna um array vazio se não houver resultados
    }
}

function getProductsByIds($connect, $ids){
    $sql = "SELECT * FROM produtos WHERE id_prod IN (".$ids.")";
    $result = $connect->query($sql); // Aqui ocorre o erro
    if($result->num_rows > 0){
        return $result->fetch_all(MYSQLI_ASSOC);
    }else{
        return array(); // Retorna um array vazio se não houver resultados
    }
}


?>
