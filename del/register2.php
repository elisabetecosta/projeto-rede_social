<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Criar conta</title>
        <link href="styles/main.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <?php
            //Estabelece a conexão à base de dados
            include_once 'includes/connect_db.php';

            //Recebe os dados do formulário
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //var_dump($dados);

            //Array de erros
            $errors = array('email' => '', 'password' => '');

            //Verifica se o utilizador clicou no botão de submissão do formulário
            if(!empty($dados['submitBtn'])) 
            {
                //Validações dos campos do formulários
                if(empty($dados['email'])) 
                {
                    $errors['email'] = 'Este campo não pode ficar vazio!';
                }

                else if(empty($dados['password'])) 
                {
                    $errors['password'] = 'Este campo não pode ficar vazio!';
                }

                else 
                {
                    //Cria a instrução sql que insere um novo registo na tabela users
                    $user_query = "INSERT INTO users 
                    (handle, email, password, regis_date) VALUES 
                    (:handle, :email, :password, NOW())";

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
                    (user_id, name, birthdate, last_updated) VALUES 
                    (:user_id, :name, :birthdate, NOW())";

                    $profile_reg = $connection->prepare($profile_query);
                    $profile_reg->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $profile_reg->bindParam(':name', $dados['profileName'], PDO::PARAM_STR);
                    $profile_reg->bindParam(':birthdate', $dados['birthdate'], PDO::PARAM_STR);
                    $profile_reg->execute();

                    //Redireciona para a página de Login
                    header("Location: index.html");
                }
            }
            
            else 
            {
                echo "Erro: Registo não foi efetuado com sucesso!";
                var_dump($dados);

                //Redireciona para a página de Login
                //header("Location: index.html");
            }
        ?>     
    </body>
</html>