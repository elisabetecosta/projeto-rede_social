<?php
    //Variáveis de conexão
    $server="127.0.0.1";
    $db="xata";
    $user="root";
    $password="";


    //Tenta fazer a conexão com a base de dados
    try {

        //Cria a variável connection (1 - ip do servidor, 2 - nome da base de dados, 3 - nome do utilizador, 4 - senha (vazia por default)) 
        $connection = new PDO("mysql:host=$server;dbname=" . $db, $user, $password);

        //echo "Conexão à base de dados realizada com sucesso!";

    } catch(PDOException $error) {

        echo "Erro: Conexão à base de dados não foi realizada com sucesso! Erro obtido: " . $error->getMessage();
    }
?>