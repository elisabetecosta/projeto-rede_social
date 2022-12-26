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
        $private = test_input($data['email']);
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
        } 


        if (isset($data['private'])) {
            //o perfil deverá ser definido como privado
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

<?php
    //Ficheiro PHP com as classes e funções      
    include 'session.php';

    //Título da página
    $title = htmlentities("Configurações");

    //Ficheiro CSS da página
    $cssFile = htmlentities("../styles/settings.css");

    //Ficheiro Javascript da página
    $jsFile = htmlentities("../scripts/settings.js");

    //Componentes html
    include '../components/head.php';               //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';             //Barra de navegação:   <header> <nav>
?>

<body>
    <div class="container">
        <div class="sidebar">
        <div class="sidebar-header">
            <i class="fa-solid fa-gear"></i>
            <div class="sidebar-desc">
                <h2>Painel de configurações</h2>
                <p>Gere os dados da tua conta</p>
            </div>
        </div>
            
            <div class="links">
                <a id="linkOne" href="#sectionOne">Opções de privacidade</a>
                <a id="linkTwo" href="#sectionTwo">Preferências</a>
                <a id="linkThree" href="#sectionThree">Palavra-passe</a>
                <a id="linkFour" href="#sectionFour">A minha conta</a>
            </div>
        </div>

        <form class="main" id="settingsForm" name="settingsForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return checkInputs()">
            <!-- Secção de opções de privacidade -->
            <section class="section" id="sectionOne">
                <h2>Opções de privacidade</h2>
                <p>Controla quem tem acesso ao teu conteúdo</p>
                <div id="wrapperOne" class="wrapper">

                    <div class="content">
                        <div class="text">
                            <h3>Perfil privado<i class="fa-solid fa-circle-info"></i></h3>
                            <p>Apenas os teus seguidores poderão ver o teu perfil e publicações</p>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="private">
                            <label for="private"></label>
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Moderar novos seguidores</h3>
                            <p>Recebe notificações para controlares quem te pode seguir</p>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="mod">
                            <label for="mod"></label>
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Receber notificações por e-mail</h3>
                            <p>Recebe um e-mail quando tiveres novas notificações</p>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="notif">
                            <label for="notif"></label>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Secção de preferências -->
            <section class="section" id="sectionTwo">
                <h2>Preferências</h2>
                <p>Personaliza e controla a tua experiência</p>
                <div id="wrapperTwo" class="wrapper">
                    <div class="content">
                        <div class="text">
                            <h3>Nome de perfil</h3>
                            <p>Este é o nome que vai aparecer no teu perfil</p>
                        </div>
                        <div class="form-control text-input">
                            <label for="profileName"></label>
                            <input type="text" id="profileName" placeholder="Nome de perfil">

                            <i class="fa-solid fa-circle-check"></i>
                            <i class="fa-solid fa-circle-xmark"></i>
                            <small>Error message</small>
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Homepage</h3>
                            <p>Página para a qual serás redirecionado ao iniciar sessão</p>
                        </div>

                        <div class="dropdown">
                            <div class="select">
                                <span class="selected">Perfil</span>
                                <div class="arrow"><i class="fa-solid fa-sort-down"></i></div>
                            </div>
                            <ul class="menu">
                                <li>Perfil</li>
                                <li>Timeline</li>
                            </ul>
                        </div>                            
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Idioma</h3>
                            <p>Idioma no qual o site será exibido</p>
                        </div>

                        <div class="dropdown">
                            <div class="select">
                                <span class="selected">Português</span>
                                <div class="arrow"><i class="fa-solid fa-sort-down"></i></div>
                            </div>
                            <ul class="menu">
                                <li>Português</li>
                                <li>English</li>
                                <li>Español</li>
                                <li>Français</li>
                            </ul>
                        </div>                            
                    </div>
                </div>
            </section>

            <section class="section" id="sectionThree">
                <h2>Palavra-passe</h2>
                <p>Altera a tua palavra-passe</p>
                <div id="wrapperThree" class="wrapper">
                    <div class="content">
                        <div class="text">
                            <h3>Palavra-passe atual</h3>
                            <p>Insere a tua palavra-passe atual</p>
                        </div>
                        <div class="form-control password-input">
                            <div class="extra">
                                <label for="passwordCurrent"></label>
                                <input type="password" id="passwordCurrent" placeholder="********">
                                <span><a href="#">Esqueci-me da palavra-passe</a></span>

                                <i class="fa-solid fa-circle-check"></i>
                                <i class="fa-solid fa-circle-xmark"></i>
                                <small>Error message</small>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Nova palavra-passe</h3>
                            <p>Insere a tua nova palavra-passe</p>
                        </div>
                        <div class="form-control password-input">
                            <label for="passwordNew"></label>
                            <input type="password" id="passwordNew" placeholder="********">

                            <i class="fa-solid fa-circle-check"></i>
                            <i class="fa-solid fa-circle-xmark"></i>
                            <small>Error message</small>
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Confirmar palavra-passe</h3>
                            <p>Insere novamente a tua nova palavra-passe para confirmar a alteração</p>
                        </div>
                        <div class="form-control password-input">
                            <label class="label" for="passwordConfirm"></label>
                            <input class="input" type="password" id="passwordConfirm" placeholder="********">

                            <i class="fa-solid fa-circle-check"></i>
                            <i class="fa-solid fa-circle-xmark"></i>
                            <small>Error message</small>
                        </div>
                    </div>
            </section>

            <section class="section" id="sectionFour">
                <h2>A minha conta</h2>
                <p>Mantém o e-mail de acesso à tua conta atualizado</p>
                <div id="wrapperFour" class="wrapper">
                    <div class="content">
                        <div class="text">
                            <h3>Endereço de e-mail</h3>
                            <p>Insere o e-mail de acesso à conta</p>
                        </div>
                        <div class="form-control text-input">
                            <label for="email"></label>
                            <input type="text" size="20" maxlength="50" id="email" placeholder="123@email.pt">

                            <i class="fa-solid fa-circle-check"></i>
                            <i class="fa-solid fa-circle-xmark"></i>
                            <small>Error message</small>
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Confirmar e-mail</h3>
                            <p>Insere novamente o teu e-mail para confirmar a alteração</p>
                        </div>
                        <div class="form-control text-input">
                            <label for="emailConfirm"></label>
                            <input type="text" size="20" maxlength="50" id="emailConfirm" placeholder="123@email.pt">

                            <i class="fa-solid fa-circle-check"></i>
                            <i class="fa-solid fa-circle-xmark"></i>
                            <small>Error message</small>
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Palavra-passe atual</h3>
                            <p>Insere a tua palavra-passe atual para confirmar todas as alterações</p>
                        </div>
                        <div class="form-control password-input">
                            <div class="extra">
                                <label for="passwordCurrentTwo"></label>
                                <input type="password" id="passwordCurrentTwo" placeholder="********">
                                <span><a href="#">Esqueci-me da palavra-passe</a></span>

                                <i class="fa-solid fa-circle-check"></i>
                                <i class="fa-solid fa-circle-xmark"></i>
                                <small>Error message</small>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="accountDelete">
                            <span><a href="#">Excluir conta<i class="fa-solid fa-triangle-exclamation"></i></a></span>
                        </div>
                    </div>
            </section>

            <div class="buttons">
                <button type="submit" name="submitBtn" id="submitBtn" value="Submeter">Submeter</button>
                <button onclick="window.history.go(-1)">Cancelar</button>
            </div>
        </form>

        <button id="scrollTopBtn" title="Top"><i class="fa-solid fa-arrow-up"></i></button>
    </div>

    <?php 
        include '../components/footer.php';              //Rodapé com links     <footer>
    ?>
</body>