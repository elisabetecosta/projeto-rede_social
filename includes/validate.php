<?php
session_start();
ob_start();

//Verifica se existem as variáveis de sessão
if((!isset ($_SESSION['user_id']) == true) AND (!isset ($_SESSION['handle']) == true))
{
    header("Location: access_error.html");
}
?>