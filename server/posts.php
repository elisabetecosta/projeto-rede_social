<?php
//============= PÁGINA DOS POSTS DO UTILIZADOR ========================

//Ficheiro PHP com as classes e funções      
include 'session.php';

//Variáveis deste documento:
$focusposts = "class='focus'";  //Aba dos posts: acrescentamos a classe ".focus" à respectiva <a> âncora
$focusfave = "";                //Aba dos favorites: sem classe
$focusflwing = "";              //Aba dos following: sem classe
$focusflwers =  "";             //Aba dos followers: sem classe
//Resultado: a aba dos posts aparece sublinhada a azul           
               
    //Título da página do SESSION['user_id']
    $title = htmlentities("{$userProfile->userData['name']} (@{$userProfile->userData['handle']})");

    //Ficheiro CSS da página
    $cssFile = htmlentities("../styles/profile.css");

    //Ficheiro Javascript da página
    $jsFile = htmlentities("../scripts/posts_form.js");

    //Chamadas de classes e funções 
    $userProfile->get_user_stats($_SESSION['user_id']);         //Chama a função que vai buscar as estatísticas do utilizador
    $userProfile->get_user_gallery($_SESSION['user_id']);       //Chama a função que vai buscar a Galeria do utilizador   
    $userPosts = new Posts();
    $userPosts->get_user_posts($_SESSION['user_id']);           //Chama a função que vai buscar os Posts do utilizador

    //Componentes html
    include '../components/head.php';                //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';              //Barra de navegação:   <header> <nav>
    include '../components/profile.header.php';      //Cabeçalho do perfil:  <main>
    include '../components/profile.posts.php';       //Conteúdo: POSTS       </main>
    include '../components/footer.php';              //Roda-pé com links     <footer>

?>
</body>
</html>
 
