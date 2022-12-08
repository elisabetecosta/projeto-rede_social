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

    //Componentes html
    include '../components/head.php';                //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';              //Barra de navegação:   <header> <nav>
    include '../components/profile.header.php';      //Cabeçalho do perfil:  <main>
    include '../components/profile.posts.php';       //Conteúdo: POSTS       </main>
    include '../components/footer.php';              //Roda-pé com links     <footer>

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</body>
</html>
 
