<!DOCTYPE html>
<html lang="<?php echo htmlentities($userSettings->language); ?>">
<head>
    <meta charset="<?php echo htmlentities($userSettings->charset); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo htmlentities($userSettings->metaTags); ?>">

    <!-- O Título da página é definido com a variável $title. -->
    <title><?=$title?></title>
    
    <!-- CSS do navbar -->
    <link rel="stylesheet" href="../styles/navbar.css">

    <!-- CSS local: $cssFile = nome do ficheiro css específico da página -->
    <link href="../styles/<?php echo $cssFile; ?>" rel="stylesheet" type="text/css">

    <!-- Importação das fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!--Importação da biblioteca de ícones font awesome-->
    <script src="https://kit.fontawesome.com/4489f75108.js" crossorigin="anonymous" defer></script>

    <!-- O ficheiro javascript da página é definido com a variável $jsFile. -->
    <script src="../scripts/<?=$jsFile?>" type="text/javascript" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" defer></script>
</head>
<body>
