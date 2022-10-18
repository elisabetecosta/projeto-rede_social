<?php
    include './includes/validate.php';
    include './includes/connect_db.php';
    header('Content-Type: application/json');

    $post = $_POST['post'];
    
    $publish = $connection->prepare('INSERT INTO posts (user_id, text, date)
                                     VALUES (:uid, :txt, NOW())');
    $publish->bindValue(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
    $publish->bindValue(':txt', $post, PDO::PARAM_STR);
    $publish->execute();

    if ($publish->rowCount() >=1 ) {
        echo json_encode('Post publicado com sucesso');
    } else {
        echo json_encode('Falha ao publicar o post');
    }
?>