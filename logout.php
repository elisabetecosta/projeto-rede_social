<?php 
    //Inicia ou recupera a atual sessão
    session_start();

    //Inicia o buffer e bloqueia qualquer saída para o navegador para evitar erros de redirecionamento
    ob_start();

    //Remove as variáveis de sessão, terminando assim a sessão
    unset($_SESSION['user_id'], $_SESSION['name']);
    $_SESSION['msg'] = "<small style='color: green'>Sessão terminada com sucesso!</small>";

    //Após terminar a sessão, redireciona para o index
    header("Location: index.php");
?>