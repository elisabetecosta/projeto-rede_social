<?php
//============= PÁGINA DOS SEGUIDORES DO UTILIZADOR ========================

    $focusposts = "";                //Aba dos posts: sem classe   
    $focusfave = "";                 //Aba dos favorites: sem classe
    $focusflwing = "";               //Aba dos following: sem classe
    $focusflwers =  "class='focus'"; //Aba dos followers: acrescentamos a classe ".focus" à respectiva <a> âncora
    //Resultado: a aba dos followers aparece sublinhada a azul

    //Componentes                                   
    include 'session.php';                          //Ficheiro PHP com as validações e variáveis de sessão     
    include '../components/head.php';               //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';             //Barra de navegação:   <header> <nav>
    include '../components/profile.header.php';     //Cabeçalho do perfil:  <main>
    include '../components/profile.followers.php';  //Conteúdo: FOLLOWERS   </main>
    include '../components/footer.php';             //Roda-pé com links     <footer>
?>

<script src="../scripts/posts_dropdown.js"></script>
</body>
</html>
 
