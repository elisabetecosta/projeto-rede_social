<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <!--Importação do ficheiro css-->
    <link href="../styles/settings.css" rel="stylesheet" type="text/css">
    <!--Importação do ficheiro javascript-->
    <script src="../scripts/settings.js" type="text/javascript" defer></script>
   

    <!--Importação das fontes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!--Importação da biblioteca de ícones font awesome-->
    <script src="https://kit.fontawesome.com/4489f75108.js" crossorigin="anonymous" defer></script>
</head>
<body>
    

        <?php
            include '../components/navbar.php';
        ?>


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
                <a href="#section-one">Opções de privacidade</a>
                <a href="#section-two">Preferências</a>
                <a href="#section-three">Palavra-passe</a>
                <a href="#section-four">A minha conta</a>
            </div>
        </div>

        <div class="main">
            <!-- Secção de opções de privacidade -->
            <section class="section" id="section-one">
                <h2>Opções de privacidade</h2>
                <p>Controla quem tem acesso ao teu conteúdo</p>
                <div class="wrapper">

                    <div class="content">
                        <div class="text">
                            <h3>O meu perfil é privado<i class="fa-solid fa-circle-info"></i></h3>
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
            <section class="section" id="section-two">
                <h2>Preferências</h2>
                <p>Personaliza e controla a tua experiência</p>
                <div class="wrapper">
                    <div class="content">
                        <div class="text">
                            <h3>Nome de perfil</h3>
                            <p>Este é o nome que vai aparecer no teu perfil</p>
                        </div>
                        <div class="text-input">
                            <label for="handle"></label>
                            <input type="text" id="handle" placeholder="Nome de perfil">
                        </div>
                    </div>

                    <div class="content">
                        <div class="text">
                            <h3>Homepage</h3>
                            <p>Página para a qual serás redirecionado ao iniciar sessão</p>
                        </div>

                        <select>
                            <option value="0">Perfil</option>
                            <option value="1">Timeline</option>
                        </select>

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
                </div>
            </section>

            <section class="section" id="section-three">
                <h2>Palavra-passe</h2>
                <p>Altera a tua palavra-passe</p>
                <div class="wrapper">
                    <div class="content">
                        <div class="text">
                            <h3>Palavra-passe atual</h3>
                            <p>Insere a tua palavra-passe atual</p>
                        </div>
                        <div class="password-input">
                            <label for="password-current"></label>
                            <input type="password" id="password-current" placeholder="********">
                        </div>
                    </div>
            </section>

            <section class="section"></section>

            <div class="buttons">
                
            </div>
        </div>
    </div>


</body>
</html>