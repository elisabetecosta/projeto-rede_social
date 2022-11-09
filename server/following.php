<?php
//============= PÁGINA DOS PERFIS QUE O UTILIZADOR SEGUE ========================

    $focusposts = "";                //Aba dos posts: sem classe   
    $focusfave = "";                 //Aba dos favorites: sem classe
    $focusflwing = "class='focus'";  //Aba dos following: acrescentamos a classe ".focus" à respectiva <a> âncora
    $focusflwers =  "";              //Aba dos followers: sem classe
    //Resultado: a aba dos following aparece sublinhada a azul

    //Componentes  
    include 'session.php';                          //Ficheiro PHP com as validações e variáveis de sessão   
    include '../components/head.php';               //Cabeçalho do HTML:    <doctype>, <head>, <body>, <link>, <styles defer>
    include '../components/navbar.php';             //Barra de navegação:   <header> <nav>
    include '../components/profile.header.php';     //Cabeçalho do perfil:  <main>
    include '../components/profile.following.php';  //Conteúdo: FOLLOWING   </main>
    include '../components/footer.php';             //Roda-pé com links     <footer>
?>

<script src="../scripts/posts_dropdown.js"></script>
</body>
</html>
 
