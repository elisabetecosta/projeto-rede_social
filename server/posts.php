<?php
//============= PÁGINA DOS POSTS DO UTILIZADOR ========================

    $focusposts = "class='focus'";  //Aba dos posts: acrescentamos a classe ".focus" à respectiva <a> âncora
    $focusfave = "";                //Aba dos favorites: sem classe
    $focusflwing = "";              //Aba dos following: sem classe
    $focusflwers =  "";             //Aba dos followers: sem classe
    //Resultado: a aba dos posts aparece sublinhada a azul

    //Componentes
    include 'session.php';                      //Ficheiro PHP com as validações e variáveis de sessão 
    include '../components/head.php';           //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';         //Barra de navegação:   <header> <nav>
    include '../components/profile.header.php'; //Cabeçalho do perfil:  <main>
    include '../components/profile.posts.php';  //Conteúdo: POSTS       </main>
    include '../components/footer.php';         //Roda-pé com links     <footer>
?>

<script src="../scripts/posts_dropdown.js"></script> 

</body>
</html>
 
