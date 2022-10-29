<?php

//DADOS NAO ESTAO A PERSISTIR APOS SUBMISSAO
// VALIDAR SE A CHECKBOX TERMOS ESTA SELECIONADA, solucao encontrada esta a dar erros
// VALIDAR EMAIL E UTILIZADOR UNICOS
// VALIDAR IDADE



    //Estabelece a conexão à base de dados
    include_once 'includes/connect_db.php';

    //Recebe os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados);

    //Inicializa as variáveis antes do formulário ser submetido para que os dados inseridos pelo utilizador não sejam perdidos na submissão se ocorrer um erro
    $email = $handle = $profileName = $birthdate = '';

    //Atribui às variáveis os valores inseridos pelo utilizador para que esses valores permaneçam após a submissão do formulário
    if(isset($dados['email'])) {
        $email = $dados['email'];
    }

    if(isset($dados['handle'])) {
        $email = $dados['handle'];
    }

    if(isset($dados['profileName'])) {
        $email = $dados['profileName'];
    }

    if(isset($dados['birthdate'])) {
        $email = $dados['birthdate'];
    }

    //Cria um array de erros
    $errors = array('email' => '', 'password' => '', 'passwordTwo' => '', 'handle' => '', 'profileName' => '', 'birthdate' => '', 'terms' => '');


    //FUNÇÕES
    function checkInputs() {

        if(empty($dados['email'])) {
            $errors['email'] = "<p style='color: red;'>Este campo não pode ficar vazio!</p>";

        } else if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "<p style='color: red;'>Insira um endereço de e-mail válido!</p>";
        }
        

        if(empty($dados['password'])) {
            $errors['password'] = "<p style='color: red;'>Este campo não pode ficar vazio!</p>";

        } else if(strlen($dados['password']) < 8) {
            $errors['password'] = "<p style='color: red;'>A palavra-passe deve ter pelo menos 8 caracteres!</p>";
        }
        

        if(empty($dados['passwordTwo'])) {
            $errors['passwordTwo'] = "<p style='color: red;'>Este campo não pode ficar vazio!</p>";

        } else if($dados['passwordTwo'] != $dados['password']) {
            $errors['passwordTwo'] = "<p style='color: red;'>As palavras-passe não são iguais!</p>";
        }
        
        
        if(empty($dados['handle'])) {
            $errors['handle'] = "<p style='color: red;'>Este campo não pode ficar vazio!</p>";

        } else if(!preg_match('/^[A-Za-z][A-Za-z0-9_-]{5,15}$/', $dados['handle'])) {
            $errors['handle'] = "<p style='color: red;'>Este campo deve conter entre 5 e 15 caracteres (a-Z, 0-9, _, -)</p>";
        }
        
        
        if(empty($dados['profileName'])) {
            $errors['profileName'] = "<p style='color: red;'>Este campo não pode ficar vazio!</p>";
        } 
        
        
        if(empty($dados['birthdate'])) {
            $errors['birthdate'] = "<p style='color: red;'>Este campo não pode ficar vazio!</p>";

        } else {
            validateAge();
        }

        // if(!isset($dados['terms'])) {
        //     $errors['terms'] = "<p style='color: red;'>Tem de aceitar os termos para concluir o registo!</p>";
        // }
    }

    function validateAge() {
        $birthdate = $_POST['birthdate']; // $dados['birthdate']
        $today = date("Y-m-d");
        $diff = date_diff(date_create($birthdate), date_create($today));
        echo 'Your age is '.$diff->format('%y');

        if($diff < 18) {
            $errors['birthdate'] = "<p style='color: red;'>Não é permitido o registo de menores de 18!</p>";
        }
    }


    //Verifica se o utilizador clicou no botão de submissão do formulário
    if(!empty($dados['submitBtn'])) 
    {
        //Chama a função que faz a validação dos campos
        checkInputs();

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
        //header("Location: index.html");
    }
    
    else 
    {
        echo "Erro: Registo não foi efetuado com sucesso!";
        var_dump($dados);

        //Redireciona para a página de Login
        //header("Location: index.html");
    }


    
?>     


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <!--Importação do ficheiro css-->
    <link href="styles/form.css" rel="stylesheet" type="text/css">
    <!--Importação do ficheiro javascript-->
    <!-- <script src="./scripts/registry_form.js" type="text/javascript" defer></script> -->

    <!--Importação das fontes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!--Importação da biblioteca de ícones font awesome-->
    <script src="https://kit.fontawesome.com/4489f75108.js" crossorigin="anonymous" defer></script>
</head>
<body>    
    <header class="header">
        <img src="images/logo.svg" alt="logo" id="logo">
    </header>

    <div class="container">
        <h1>Criar conta</h1>
        <form id="regForm" class="form" name="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return checkInputs()">
            <!--Secção 1 do formulário-->
                <div class="form-control">
                    <label class="label" for="email">E-mail </label>
                    <input class="input" type="text" size="20" maxlength="50" name="email" id="email" placeholder="123@email.pt" value="<?php echo htmlspecialchars($email) ?>">
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
                    <input class="input" type="text" size="20" maxlength="15" name="handle" id="handle" placeholder="@xata94" value="<?php echo htmlspecialchars($handle) ?>">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-xmark"></i>
                    <small>Error message</small>
                    <div class="php-error"><?php echo $errors['handle']; ?></div>
                </div>

                <div class="form-control">
                    <label class="label" for="profileName">Nome de perfil </label>
                    <input class="input" type="text" size="20" maxlength="45" name="profileName" id="profileName" placeholder="Xateada" value="<?php echo htmlspecialchars($profileName) ?>">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-xmark"></i>
                    <small>Error message</small>
                    <div class="php-error"><?php echo $errors['profileName']; ?></div>
                </div>

                <div class="form-control">
                    <label class="label" for="birthdate">Data de nascimento </label>
                    <input class="input" type="date" size="11" name="birthdate" id="birthdate" value="<?php echo htmlspecialchars($birthdate) ?>">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-xmark"></i>
                    <small>Error message</small>
                    <div class="php-error"><?php echo $errors['birthdate']; ?></div>
                </div>

                <div class="form-control terms">
                    <input type="checkbox" name="terms" id="terms" value="1">
                    <label for="terms">&nbsp;Aceito os termos de utilização e política de privacidade</label>
                    <small>Error message</small>
                    <div class="php-error"><?php echo $errors['terms']; ?></div>
                </div>
            
            <button type="submit" name="submitBtn" id="submitBtn" value="Criar conta">Criar conta</button>
            <span>Já tens uma conta? Inicia sessão <a href="index.html">aqui</a>.</span>
        </form>
    </div>
</body>
</html>