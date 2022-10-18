<?php
    //Estabelece a conexão à base de dados
    include_once '../includes/connect_db.php';

    //Variável que recebe os dados enviados através do input
    $email= $_POST['email'];

    //Cria a query responsável por selecionar os registos do campo indicado
    $email_query = "SELECT email FROM users WHERE email = '$email'";

    //A base de dados prepara a query
    $email_check = $connection->prepare($email_query);

    //Executa a query
    $email_check->execute();

    //Conta o número de registos que coincidem com o valor enviado através do input e armazena o resultado na variável
    $email_result = $email_check->rowCount();

    //Se não existir nenhum registo, devolve uma string de texto vazia
    if($email_result == 0) 
    {
        echo "";
    }

    //Caso contrário, devolve uma mensagem de erro
    else 
    {
        echo "Este endereço de e-mail já se encontra registado!";
    }
?>