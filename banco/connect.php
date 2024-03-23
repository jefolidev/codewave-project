<?php 
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $banco = "compras";

    return new mysqli($localhost, $username, $password, $banco);
?>