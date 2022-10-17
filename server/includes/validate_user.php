<?php
    //Estabelece a conexão à base de dados
    include_once 'connect_db.php';

    //Variáveis que recebem os dados enviados através dos inputs
    $email= $_POST['email'];
    $password= $_POST['password'];


    //Cria a instrução SQL que seleciona o utilizador correspondente ao inserido no formulário
    $user_query = "SELECT user_id, email, password 
    FROM users 
    WHERE email = :email 
    LIMIT 1";

    //A base de dados prepara a query
    $user_result = $connection->prepare($user_query);

    //Faz a ligação entre os dados inseridos no formulário e os campos da tabela
    $user_result->bindParam(':email', $email, PDO::PARAM_STR);

    //Executa a query
    $user_result->execute();


    //Verifica se os dados coincidem e se o utilizador existe na base de dados
    if (($user_result) and ($user_result->rowCount() != 0)) {
        //Procura o utilizador e devolve o resultado
        $user_row = $user_result->fetch(PDO::FETCH_ASSOC);

        //var_dump($user_row);

        //Verifica se a palavra-passe inserida corresponde à armazenada na base de dados
        if ($password == $user_row['password']) {
            $_SESSION['user_id'] = $user_row['user_id'];
            $_SESSION['name'] = $user_row['name'];
            header("Location: profile.php");
            echo "";

        } else {
            echo "E-mail ou palavra-passe inválidos!";
        }     
    } 
    
    else {
        echo "E-mail ou palavra-passe inválidos!";
    }
?>