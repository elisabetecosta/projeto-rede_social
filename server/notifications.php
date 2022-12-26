<?php
    //Ficheiro PHP com as classes e funções      
    include 'session.php';

    //Título da página
    $title = htmlentities("Notificações");

    //Ficheiro CSS da página
    $cssFile = htmlentities("../styles/notifications.css");

    //Ficheiro Javascript da página
    $jsFile = htmlentities("../scripts/notifications.js");

    //Componentes html
    include '../components/head.php';               //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';             //Barra de navegação:   <header> <nav>
?>


<body>
    <div class="wrapper">
        <div class="container">
            <header>
                <div class="notif_box">
                <i class="fa-solid fa-bell"></i>
                <h2 class="title">Notificações</h2>
                <span id="notifes"></span>
                </div>
                <p id="mark_all">Marcar todas como lidas</p>
            </header>
            <main>
                <div class="notif_card unread">
                    <img src="../users/<?=$userProfile->userData['handle']?>/<?=$userProfile->userData['avatar']?>" alt="avatar"/>
                    <div class="description">
                        <p class="user_activity">
                        <strong>Elisabete Costa</strong> reagiu à tua publicação mais recente
                        <b>Parabéns!</b>
                        </p>
                        <p class="time">há 1 minuto</p>
                    </div>
                </div>

                <div class="notif_card">
                    <div class="message_card">
                        <img src="../users/<?=$userProfile->userData['handle']?>/<?=$userProfile->userData['avatar']?>" alt="avatar"/>
                        <div class="description">
                            <p class="user_activity">
                            <strong>Ana Almeida</strong> enviou-te uma mensagem privada
                            </p>
                            <p class="time">há 2 horas</p>
                        </div>

                        <div class="message">
                            <p>
                                Olá, tudo bem? Já conseguiste terminar a tua parte?
                            </p>
                        </div>
                    </div>
                    
                </div>

                <div class="notif_card">
                    <img src="../users/<?=$userProfile->userData['handle']?>/<?=$userProfile->userData['avatar']?>" alt="avatar"/>
                    <div class="description">
                        <p class="user_activity">
                        <strong>Sara Costa</strong> deixou um comentário na tua foto
                        </p>
                        <p class="time">há 1 semana</p>
                    </div>
                    <img src="../images/cat.png" class="random_img" alt="cat" />
                </div>
            </main>
        </div>
    </div>

    <?php
    include '../components/footer.php';              //Rodapé com links     <footer>
    ?>
</body>