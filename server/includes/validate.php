<?php
    //Inicia ou recupera a atual sessão
    session_start();

    //Inicia o buffer e bloqueia qualquer saída para o navegador para evitar erros de redirecionamento
    ob_start();

    //Verifica se existem as variáveis de sessão, e se não existirem redireciona para uma página de erro
    if((!isset ($_SESSION['user_id']) == true) AND (!isset ($_SESSION['handle']) == true))
    {
        header("Location: access_error.html");
    }
?>