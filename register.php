<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <!--Ao fim de 1 segundo redireciona para o index.html, que é a página de login-->
        <!-- <meta http-equiv="refresh" content="1; url=index.html"> -->
        <title>Criar conta</title>
        <link href="styles/main.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <?php

            //falta o validate.php


            //Estabelece a conexão à base de dados
            include 'includes/connect_db.php';

            //Recebe os dados do formulário
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //var_dump($dados);

            //Verifica se o utilizador clicou no botão de submissão do formulário
            if(!empty($dados['submit'])) {

                //Cria a instrução sql que insere um novo registo na tabela users
                $user_query = "INSERT INTO users 
                (handle, email, password) VALUES 
                (:handle, :email, :password)";

                //Faz a ligação entre os dados inseridos no formulário e os campos da tabela 
                $user_reg = $connection->prepare($user_query);
                $user_reg->bindParam(':handle', $dados['handle'], PDO::PARAM_STR);
                $user_reg->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $user_reg->bindParam(':password', $dados['password'], PDO::PARAM_STR);

                //Executa a query
                $user_reg->execute();
            
                //Variável que armazena o último id inserido
                $user_id = $connection->lastInsertId();


                //Repete o processo anterior, desta vez para a tabela profiles
                $profile_query = "INSERT INTO profiles 
                (user_id, name, birthdate) VALUES 
                (:user_id, :name, :birthdate)";

                $profile_reg = $connection->prepare($profile_query);
                $profile_reg->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $profile_reg->bindParam(':name', $dados['name'], PDO::PARAM_STR);
                $profile_reg->bindParam(':birthdate', $dados['birthdate'], PDO::PARAM_STR);
                $profile_reg->execute();

                //Redireciona para a página de Login
                header("Location: index.html");

            }

            else {
                echo "Erro: Registo não foi efetuado com sucesso!";

                //Redireciona para a página de Login
                header("Location: index.html");
            }

            //Cria a instrução sql que insere um novo registo com os dados recebidos do formulário através do método POST
            // $sql = "INSERT INTO users (handle, email, password) 
            // VALUES ('$_POST[handle]', '$_POST[email]', '$_POST[password]')";

            // $sql2 = "INSERT INTO profiles (user_id, name, birthdate)
            // VALUES (:user_id, '$_POST[name]', '$_POST[birthdate]')";


            // // Caso consiga executar a ação, mostra a mensagem de sucesso[apos testes remover if e echo e deixar so o comando mysqli_query]
            // if (mysqli_query($connection, $sql))
            // echo "<h3> Registo em users efetuado com sucesso! <h3/>";

            // if (mysqli_query($connection, $sql2))
            // echo "<h3> Registo em profiles efetuado com sucesso! <h3/>";


            
            //TESTAR PARA ESCREVER MENOS CODIGO E UTILIZAR UMA SO VARIAVEL
            // mysqli_multi_query($connection, $sql);


            //mysqli_close($connection);
        ?>
            
    </body>
</html>