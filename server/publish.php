<?php
    include 'includes/validate.php';
    include 'includes/connect_db.php';
    //header('Content-Type: application/json');

    $goto = 'posts.php';
    include '../components/refresh.php';

    $input = $_POST['newpost-text'];

    //Verifica se o post tem de 0 até 255 caracteres 
    if ((strlen($input) > 0) &&  (strlen($input) < 255)) { 
        $publish = $connection->prepare('INSERT INTO posts (user_id, text, date)
                                        VALUES (:uid, :txt, NOW())');
        $publish->bindValue(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
        $publish->bindValue(':txt', $input, PDO::PARAM_STR);
        $publish->execute();
    } else {
        return false;
    }
?>