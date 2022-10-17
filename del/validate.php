<?php
    session_start();

    //Validação das variáveis de sessão
    if((!isset ($_SESSION['id']) == true) and (!isset ($_SESSION['handle']) == true))
    {
        header('location:index.php');
    }
?>