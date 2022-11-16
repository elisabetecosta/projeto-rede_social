<?php
    //Estabelece a conexão à base de dados
    include_once 'includes/connect_db.php';

    //Recebe os dados do formulário
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($data);

    //Inicializa as variáveis antes do formulário ser submetido para que os dados inseridos pelo utilizador não sejam perdidos na submissão se ocorrer um erro
    $email = $handle = $profileName = $birthdate = $terms = '';

    //Se o formulário for submetido através do método POST, testa os dados introduzidos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($data['email']);
        $password = test_input($data['password']);
        $passwordTwo = test_input($data['passwordTwo']);
        $handle = test_input($data['handle']);
        $profileName = test_input($data['profileName']);
        $birthdate = test_input($data['birthdate']);
    }

    //Função que testa os dados removendo espaços e barras e convertendo caracteres especiais em entidades html para evitar injeção de código malicioso
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Cria um array de erros
    $errors = array('email' => '', 'password' => '', 'passwordTwo' => '', 'handle' => '', 'profileName' => '', 'birthdate' => '', 'terms' => '');


    //Verifica se o utilizador clicou no botão de submissão do formulário
    if (!empty($data['submitBtn'])) {

        //Faz as validações dos campos

        if (empty($data['email'])) {
            $errors['email'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este campo não pode ficar vazio!</p>";
        } else {

            $email = test_input($data['email']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Insira um endereço de e-mail válido!</p>";
            } else {

                $email = test_input($data['email']);

                //Cria a query responsável por selecionar os registos do campo indicado
                $email_query = "SELECT email FROM users WHERE email = '$email'";

                //A base de dados prepara a query
                $email_check = $connection->prepare($email_query);

                //Executa a query
                $email_check->execute();

                //Conta o número de registos que coincidem com o valor enviado através do input e armazena o resultado na variável
                $email_result = $email_check->rowCount();

                //Se existir algum registo, devolve uma mensagem de erro
                if ($email_result != 0) {
                    $errors['email'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este endereço de e-mail já se encontra registado!</p>";
                }
            }
        }


        if (empty($data['password'])) {
            $errors['password'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este campo não pode ficar vazio!</p>";
        } else {
            $password = test_input($data['password']);

            if (strlen($data['password']) < 8) {
                $errors['password'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>A palavra-passe deve ter pelo menos 8 caracteres!</p>";
            }
        }


        if (empty($data['passwordTwo'])) {
            $errors['passwordTwo'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este campo não pode ficar vazio!</p>";
        } else {
            $passwordTwo = test_input($data['passwordTwo']);

            if ($data['passwordTwo'] != $data['password']) {
                $errors['passwordTwo'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>As palavras-passe não são iguais!</p>";
            }
        }


        if (empty($data['handle'])) {
            $errors['handle'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este campo não pode ficar vazio!</p>";
        } else {
            $handle = test_input($data['handle']);

            if (!preg_match('/^[A-Za-z][A-Za-z0-9_-]{4,15}$/', $data['handle'])) {
                $errors['handle'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este campo deve conter entre 5 e 15 caracteres (a-Z, 0-9, _, -)</p>";
            } else {

                $handle = test_input($data['handle']);

                //Cria a query responsável por selecionar os registos do campo indicado
                $handle_query = "SELECT handle FROM users WHERE handle = '$handle'";

                //A base de dados prepara a query
                $handle_check = $connection->prepare($handle_query);

                //Executa a query
                $handle_check->execute();

                //Conta o número de registos que coincidem com o valor enviado através do input e armazena o resultado na variável
                $handle_result = $handle_check->rowCount();

                //Se existir algum registo, devolve uma mensagem de erro
                if($handle_result != 0) {
                    $errors['handle'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este nome de utilizador já se encontra registado!</p>";
                }
            }
        }


        if (empty($data['profileName'])) {
            $errors['profileName'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este campo não pode ficar vazio!</p>";
        }


        if (empty($data['birthdate'])) {
            $errors['birthdate'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Este campo não pode ficar vazio!</p>";
        } else {
            $birthdate = test_input($data['birthdate']);
            $today = date("Y-m-d");
            $diff = date_diff(date_create($birthdate), date_create($today));
            $age = $diff->format('%y');

            if ($age < 18) {
                $errors['birthdate'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Não é permitido o registo de menores de 18!</p>";
            }
        }


        if (!isset($data['terms'])) {
            $errors['terms'] = "<p style='margin-top: 5px; font-size: 14px; color: #DB5A5A;'>Tem de aceitar os termos para concluir o registo!</p>";
        }


        //Caso não sejam encontrados erros, executa o processo de registo 
        else {
            //Cria a instrução sql que insere um novo registo na tabela users
            $user_query = "INSERT INTO users 
                (handle, email, password, regis_date) VALUES 
                (:handle, :email, :password, NOW())";

            //Faz a ligação entre os dados inseridos no formulário e os campos da tabela 
            $user_reg = $connection->prepare($user_query);
            $user_reg->bindParam(':handle', $data['handle'], PDO::PARAM_STR);
            $user_reg->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $user_reg->bindParam(':password', $data['password'], PDO::PARAM_STR);

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
            $profile_reg->bindParam(':name', $data['profileName'], PDO::PARAM_STR);
            $profile_reg->bindParam(':birthdate', $data['birthdate'], PDO::PARAM_STR);
            $profile_reg->execute();

            //Destrói as variáveis para impedir registos duplicados acidentais
            unset($data);

            //Redireciona para a página de Login (usar /index.php ou /login)
            header("Location: ../login");
        }
    }

    
    //====> se descomentar o código abaixo a mensagem de erro fica visivel sempre que a página é visitada
    // //Caso o registo não funcione, executa o que está dentro do else
    // else {
    //     echo "Erro: Registo não foi efetuado com sucesso!";
    //     var_dump($data);

    //     //Redireciona para a página de Login (usar /index.php ou /login)
    //     //header("Location: index.php");
    // }
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <!--Importação do ficheiro css-->
    <link href="../styles/registry_form.css" rel="stylesheet" type="text/css">
    <!--Importação do ficheiro javascript-->
    <script src="../scripts/registry_form.js" type="text/javascript" defer></script>

    <!--Importação das fontes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!--Importação da biblioteca de ícones font awesome-->
    <script src="https://kit.fontawesome.com/4489f75108.js" crossorigin="anonymous" defer></script>
</head>

<body>
    <header class="header">
        <img src="../images/logo.svg" alt="logo" id="logo">
    </header>

    <div class="container">
        <h1>Criar conta</h1>
        <form id="regForm" class="form" name="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return checkInputs()">
            <!--Secção 1 do formulário-->
            <div class="form-control">
                <label class="label" for="email">E-mail </label>
                <input class="input" type="text" size="20" maxlength="50" name="email" id="email" placeholder="123@email.pt" value="<?php echo $email; ?>">
                
                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-xmark"></i>
                <small>Error message</small>
                <div class="php-error"><?php echo $errors['email']; ?></div>
            </div>

            <div class="form-control">
                <label class="label" for="password">Palavra-passe </label>
                <input class="input" type="password" size="20" maxlength="255" name="password" id="password" placeholder="********">

                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-xmark"></i>
                <small>Error message</small>
                <div class="php-error"><?php echo $errors['password']; ?></div>
            </div>

            <div class="form-control">
                <label class="label" for="passwordTwo">Confirmar palavra-passe </label>
                <input class="input" type="password" size="20" maxlength="255" name="passwordTwo" id="passwordTwo" placeholder="********">

                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-xmark"></i>
                <small>Error message</small>
                <div class="php-error"><?php echo $errors['passwordTwo']; ?></div>
            </div>


            <!--Secção 2 do formulário-->
            <div class="form-control">
                <label class="label" for="handle">Nome de utilizador </label>
                <input class="input" type="text" size="20" maxlength="15" name="handle" id="handle" value="<?php echo $handle; ?>">
                <i class="fa-solid fa-at"></i>


                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-xmark"></i>
                <small>Error message</small>
                <div class="php-error"><?php echo $errors['handle']; ?></div>
            </div>

            <div class="form-control">
                <label class="label" for="profileName">Nome de perfil </label>
                <input class="input" type="text" size="20" maxlength="45" name="profileName" id="profileName" placeholder="Xateada" value="<?php echo $profileName; ?>">

                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-xmark"></i>
                <small>Error message</small>
                <div class="php-error"><?php echo $errors['profileName']; ?></div>
            </div>

            <div class="form-control">
                <label class="label" for="birthdate">Data de nascimento </label>
                <input class="input" type="date" size="11" name="birthdate" id="birthdate" value="<?php echo $birthdate; ?>">

                <small>Error message</small>
                <div class="php-error"><?php echo $errors['birthdate']; ?></div>
            </div>

            <div class="form-control terms">
                <span>
                    <input type="checkbox" name="terms" id="terms-input">
                    <label for="terms" id="terms-label">&nbsp;Aceito os termos de utilização e política de privacidade</label>
                </span>

                <small>Error message</small>
                <div class="php-error"><?php echo $errors['terms']; ?></div>
            </div>

            <button type="submit" name="submitBtn" id="submitBtn" value="Criar conta">Criar conta</button>
            <span>Já tens uma conta? Inicia sessão <a href="../login">aqui</a>.</span>
        </form>
    </div>
</body>
</html>