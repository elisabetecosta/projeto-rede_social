<?php
//============= PÁGINA DOS FAVORITOS DO UTILIZADOR ========================

    //Ficheiro PHP com as classes e funções      
    include 'session.php';

    //Variáveis deste documento:
    $focusposts = "";               //Aba dos posts: sem classe
    $focusfave = "class='focus'";   //Aba dos favorites: acrescentamos a classe ".focus" à respectiva <a> âncora
    $focusflwing = "";              //Aba dos following: sem classe
    $focusflwers =  "";             //Aba dos followers: sem classe
    //Resultado: a aba dos posts aparece sublinhada a azul

    //Título da página
    $title = htmlentities("Favoritos da {$userProfile->userData['name']}");

    //Ficheiro CSS da página
    $cssFile = htmlentities("../styles/profile.css");

    //Ficheiro Javascript da página
    $jsFile = htmlentities("../scripts/posts_dropdown.js");

    //Chamadas de classes e funções 
    $userProfile->get_user_stats($_SESSION['user_id']);         //Chama a função que vai buscar as estatísticas do utilizador
    $userProfile->get_user_gallery($_SESSION['user_id']);       //Chama a função que vai buscar a Galeria do utilizador   
    $userProfile->get_favorited_posts($_SESSION['user_id']);    //Chama a função que vai buscar os Posts Favoritos do utilizador   
    $userProfile->display_followings($_SESSION['user_id']);     //Chama a função que vai buscar as contas que utilizador segue
    $userPosts = new Posts();
    $userPosts->get_user_posts($_SESSION['user_id']);           //Chama a função que vai buscar os Posts do utilizador

    //Componentes html
    include '../components/head.php';               //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';             //Barra de navegação:   <header> <nav>
    include '../components/profile.header.php';     //Cabeçalho do perfil:  <main>
    include '../components/profile.favorites.php';  //Conteúdo: FAVORITES   </main>
    include '../components/footer.php';             //Roda-pé com links     <footer>
?>

</body>
</html>
 