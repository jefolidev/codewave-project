<?php 
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $banco = "compras";

    $connect = new mysqli($localhost, $username, $password, $banco);

    if($connect->connect_error){
        echo "Erro ao fazer a conexão";
    }else{
        echo "Conexão feita com sucesso";
    }
?>