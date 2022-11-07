<?php
    //Verifica se o Utilizador tem sessão iniciada
    include 'includes/validate.php';

    //Faz o refresh da página (espera 0 segundos) após a inserção do post da base de dados
    $goto = 'posts.php'; //redirecciona para a página posts.php
    include '../components/refresh.php';

    //Se o formulário for submetido através do método POST, testa os dados introduzidos
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        //Se o botão "publicar" for clicado
        if(isset($_POST['Publicar'])){

            //Filtra o array introduzido pelo utilizador
            $input = filter_input(INPUT_POST, 'newpost-text', FILTER_SANITIZE_STRING);

            //Remove os espaços em branco e caracteres especiais (posts só com espaços branco passam a vazio)
            $input = trim($input);

            //Normaliza a string, removendo todos os espaços em branco duplicados (ou casos excessivos de espaços seguidos)
            $input = preg_replace('/\s+/', ' ', $input);

            //Se o post não estiver vazio e de tiver entre 1 e 255 caracteres, é publicado
            if(!empty($input) && (strlen($input) > 0) && (strlen($input) < 255)){

                //Só acede à base de dados nesta instância, depois de passar pelas validações anteriores
                include 'includes/connect_db.php';
                //Query que insere os dados
                $publish = $connection->prepare('INSERT INTO posts (user_id, text, date)
                                                            VALUES (:uid, :txt, NOW())');
                $publish->bindValue(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
                $publish->bindValue(':txt', $input, PDO::PARAM_STR);
                $publish->execute();

            } else {
                return false;
            }
        }

        //Se o botão "publicar" for clicado
    }

?>