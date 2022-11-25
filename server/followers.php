<?php
//============= PÁGINA DOS SEGUIDORES DO UTILIZADOR ========================

    //Ficheiro PHP com as classes e funções      
    include 'session.php';

    //Variáveis deste documento:
    $focusposts = "";                //Aba dos posts: sem classe   
    $focusfave = "";                 //Aba dos favorites: sem classe
    $focusflwing = "";               //Aba dos following: sem classe
    $focusflwers =  "class='focus'"; //Aba dos followers: acrescentamos a classe ".focus" à respectiva <a> âncora
    //Resultado: a aba dos followers aparece sublinhada a azul

    //Título da página
    $title = htmlentities("Seguidores da {$userProfile->userData['name']}");

    //Ficheiro CSS da página
    $cssFile = htmlentities("../styles/profile.css");

    //Ficheiro Javascript da página
    $jsFile = htmlentities("../scripts/posts_dropdown.js");

    //Chamadas de classes e funções 
    $userProfile->get_user_stats($_SESSION['user_id']);
    $userProfile->display_followers($_SESSION['user_id']);

    //Componentes html
    include '../components/head.php';               //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';             //Barra de navegação:   <header> <nav>
    include '../components/profile.header.php';     //Cabeçalho do perfil:  <main>
    include '../components/profile.followers.php';  //Conteúdo: FOLLOWERS   </main>
    include '../components/footer.php';             //Roda-pé com links     <footer>
?>

</body>
</html>
 
