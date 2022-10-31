<?php
    $focusposts = "";
    $focusfave = " class='focus' ";
    $focusflwing = "";
    $focusflwers = "";
    include 'session.php';
    include '../components/head.php';
    include '../components/navbar.php';    
    include '../components/profile_header.php';
    include '../components/generate_favorites.php'
?>
 
 <script>
// Permite fechar os dropdown menus dos posts com um clique
const target = document.querySelectorAll('.target');
document.addEventListener('click', (event) => {
    for(let i = 0; i < target.length; i++){
        const withinBoundaries = event.composedPath().includes(target[i]);
        if (!withinBoundaries) {
            target[i].checked = false;
        } 
    }
})
</script>
 </body>
</html>
 