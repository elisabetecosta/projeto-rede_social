<?php 
    session_start();
    ob_start();
    unset($_SESSION['user_id'], $_SESSION['name']);
    $_SESSION['msg'] = "<small style='color: green'>Sessão terminada com sucesso!</small>";

    header("Location: index.html");
?>