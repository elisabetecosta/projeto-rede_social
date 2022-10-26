<?php
    //============== DEFINIÇÕES DO CABEÇALHO DO HTML =================
    $language = "pt-PT";
    $charset = "UTF-8";
    $metaTags = "xata, perfil, rede social";
    $title = "{$session['name']} ({$session['handle']})"; //Título da página = Nome do utilizador (@handle)
?>

<!DOCTYPE html>
<html lang="<?php echo ($language); ?>">
<head>
    <meta charset="<?php echo ($charset); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo ($metaTags); ?>">
    <title><?php echo $title; ?></title>
    <link href="../styles/profile.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<noscript>
    <style type="text/css">
        .pagecontainer {display:none;}
    </style>
    <div class="noscriptmsg">
    You don't have javascript enabled.  Good luck with that.
    </div>
</noscript>
