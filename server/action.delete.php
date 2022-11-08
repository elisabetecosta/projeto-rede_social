<?php
    //Verifica se o Utilizador tem sessão iniciada
    include './includes/validate.php';

    //Recebe o id do post
    $post_id = $_POST['id'];

    //Função que "apaga" um post pelo seu ID (na prática, coloca o status de 0 [visivel] para 1 [invisível])
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST['id'])){
            require './includes/connect_db.php';
                $deletePost = $connection->prepare("UPDATE posts
                                                    SET status = 1
                                                    WHERE post_id = :post_id");
                $deletePost->bindParam(':post_id', $post_id);
                $deletePost->execute();
        } else {
            header( "Location: posts.php" ); die;
        }
    } else {
        header( "Location: posts.php" ); die;
    }

?>