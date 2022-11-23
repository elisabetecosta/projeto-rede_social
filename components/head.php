<!DOCTYPE html>
<html lang="<?php
                    if(isset($_SESSION['user_id'])){
                        echo htmlentities($userSettings->language); //Definido pelo user (ele pode escolher outras línguas)
                    } else {
                        echo "pt-Pt";                               // Default language
                    } ?>">
<head>
    <meta charset="<?php 
                    if(isset($_SESSION['user_id'])){
                        echo htmlentities($userSettings->charset);
                    } else {
                        echo "UTF-8";                   // Default charset
                    } ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php
                    if(isset($_SESSION['user_id'])){
                        echo htmlentities($userSettings->metaTags); //Definido pelo user (ele pode escolher incluir os seus interesses pessoais)
                    } else {
                        echo "xata, rede social";                   // Default keywords
                    } ?>">

    <!-- O Título da página é definido com a variável $title. -->
    <title><?=$title?></title>
    
    <!-- CSS do navbar -->
    <?php if(isset($_SESSION['user_id'])) echo '<link rel="stylesheet" href="../styles/navbar.css">' ?>
    

    <!-- CSS local: $cssFile = nome do ficheiro css específico da página -->
    <link href="<?php echo $cssFile; ?>" rel="stylesheet" type="text/css">

    <!-- Importação das fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!--Importação da biblioteca de ícones font awesome-->
    <script src="https://kit.fontawesome.com/4489f75108.js" crossorigin="anonymous" defer></script>

    <!-- O ficheiro javascript da página é definido com a variável $jsFile. -->
    <script src="<?=$jsFile?>" type="text/javascript" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" defer></script>
</head>
<body>
