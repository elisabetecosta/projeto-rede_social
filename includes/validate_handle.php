<?php
    //Estabelece a conexão à base de dados
    include_once 'connect_db.php';

    //Variável que recebe os dados enviados através do input
    $handle= $_POST['handle'];

    //Cria a query responsável por selecionar os registos do campo indicado
    $handle_query = "SELECT handle FROM users WHERE handle = '$handle'";

    //A base de dados prepara a query
    $handle_check = $connection->prepare($handle_query);

    //Executa a query
    $handle_check->execute();

    //Conta o número de registos que coincidem com o valor enviado através do input e armazena o resultado na variável
    $handle_result = $handle_check->rowCount();

    //Se não existir nenhum registo, devolve uma string de texto vazia
    if($handle_result == 0) 
    {
        echo "";
    }

    //Caso contrário, devolve uma mensagem de erro
    else 
    {
        echo "Este nome de utilizador já se encontra registado!";
    }
?>