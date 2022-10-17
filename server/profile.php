<?php
//Contém a session start e validação da sessão
include 'includes/validate.php';

//Estabelece a conexão com a base de dados
include 'includes/connect_db.php';

//Acede aos dados do utilizador com sessão iniciada
$getProfile = $connection->prepare('SELECT users.handle, profiles.name, profiles.avatar, profiles.cover, profiles.title, profiles.desc
                                    FROM users
                                    JOIN profiles
                                    ON users.user_id = profiles.user_id
                                    WHERE users.user_id = :uid');
$getProfile->bindParam(':uid', $_SESSION['user_id']);
$getProfile->execute();
$userData = $getProfile->fetch(PDO::FETCH_ASSOC);
    /*A variável $userData contém:
                                $userData=['user_id'] = ID do utilizador
                                $userData=['handle'] = @username do utilizador
                                $userData=['name'] = Nome escolhido pelo do utilizador
                                $userData=['avatar'] = avatar do utilizador (avatar.png)
                                $userData=['cover'] = capa do utilizador (header_photo.png)
    */ 

//============== O HTML PROPRIAMENTE DITO COMEÇA AQUI =================
//Gera o cabeçalho do HTML [head.php]
$language = "pt-PT";
$charset = "UTF-8";
$metaTags = "xata, perfil, rede social";
$title = "{$userData['name']} (@{$userData['handle']})"; //Título da página = Nome do utilizador (@handle)
include '../components/head.php';

//Gera a barra de navegação superior [navbar.php] com os dados da variável $userData e com os seguintes links:
$homeURL = "main.php";              //link do logotipo XATA
$profileURL = "profile.php";        //link do avatar do user (avatar pequenino)
$notifsURL = "notifications.php";   //link do icone de notificações (sineta)
$configURL = "config.php";          //link do ícone de configurações (roda dentada)
$logoutURL = "logout.php";          //link do botão de logout
include '../components/navbar.php';    

//============== O PERFIL DO UTILIZADOR COMEÇA AQUI =================
    //Cria a header do perfil do utilizador (Capa e Avatar)
    $sessionHandle = $userData['handle'];
    $sessionCover = $userData['cover'];
    $sessionAvatar = $userData['avatar'];
    $sessionName =  $userData['name'];

    //Query que acede ao número total de Publicações deste utilizador
    $getPostCount = $connection->prepare('SELECT COUNT(post_id) AS posts FROM posts WHERE user_id = :uid');
    $getPostCount->bindParam(':uid', $_SESSION['user_id']);
    $getPostCount->execute();
    $counterPosts = $getPostCount->fetch(PDO::FETCH_ASSOC);

    //Query que acede ao número total de Favoritos deste utilizador
    $getFaveCount = $connection->prepare('SELECT COUNT(fav_id) AS faves FROM favs WHERE user_id = :uid AND NOT status=0' ); //Se o utilizador se "arrepender" de favoritar algo, o status passa a 0, logo temos de exclui-los do contador (sem eliminar o registo em si mesmo)
    $getFaveCount->bindParam(':uid', $_SESSION['user_id']);
    $getFaveCount->execute();
    $counterFaves = $getFaveCount->fetch(PDO::FETCH_ASSOC);

    //Query que acede ao número total contas que este utilizador segue
    $getFollowingCount = $connection->prepare('SELECT COUNT(follow_id) AS following FROM follows WHERE follower_id = :uid');
    $getFollowingCount->bindParam(':uid', $_SESSION['user_id']);
    $getFollowingCount->execute();
    $counterFollowing = $getFollowingCount->fetch(PDO::FETCH_ASSOC);

    //Query que acede ao número total de contas que seguem este utilizador
    $getFollowersCount = $connection->prepare('SELECT COUNT(follow_id) AS followers FROM follows WHERE followed_id = :uid');
    $getFollowersCount->bindParam(':uid', $_SESSION['user_id']);
    $getFollowersCount->execute();
    $counterFollowers = $getFollowersCount->fetch(PDO::FETCH_ASSOC);

    //Mostra as estatísticas deste utilizador 
    $posts = $counterPosts['posts'];                //Número de publicações
    $faves = $counterFaves['faves'];                //Número de favoritos
    $following = $counterFollowing['following'];    //Número de users que segue
    $followers = $counterFollowers['followers'];    //Número de seguidores
    include '../components/profile_header.php';

//============== O CONTEÚDO ALTERNA ENTRE PUBLICAÇÕES, FAVORITOS, SEGUINDO E SEGUIDORES COM UM CLIQUE NAS STATS  =================

   //==== Caixa de apresentação "Sobre mim"
   $title = $userData['title'];          // "Sobre mim" ou o título personalizado pelo utilizador
   $description = $userData['desc'];     // Descrição do perfil escrita pelo utilizador
   $uid = $_SESSION['user_id'];

    //==== Galeria de imagens
    //Carrega apenas as últimas 4 imagens publicadas por este utilizador (usamos a data de publicação/actualização da tabela posts)
    $getMedia = $connection->prepare("SELECT media.content, posts.post_id
                                    FROM media
                                    JOIN posts
                                    ON media.post_id=posts.post_id
                                    WHERE posts.user_id = :uid AND posts.status=0 AND media.status=0
                                    ORDER BY media.content ASC LIMIT 4");
    $getMedia->bindParam(':uid', $_SESSION['user_id']);
    $getMedia->execute();
    $displayMedia = $getMedia->fetchAll(PDO::FETCH_ASSOC);
    $gallerytitle = "Galeria";

    $getPosts =  $connection->prepare("SELECT text, date
                                    FROM posts
                                    WHERE user_id = :uid AND status = 0 
                                    ORDER BY date DESC LIMIT 10");
    $getPosts->bindParam(':uid', $_SESSION['user_id']);
    $getPosts->execute();
    $displayPosts = $getPosts->fetchAll(PDO::FETCH_ASSOC);

    // Função que converte a datahora armazenada em tempo relativo (exemplo: "há 5 segs")
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'ano',
            'm' => 'mês',
            'w' => 'semana',
            'd' => 'dia',
            'h' => 'hora',
            'i' => 'min',
            's' => 'seg',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) : 'agora mesmo';
    }

    //Função que impede o utilizador de publicar um post vazio ou com mais do que 255 caracteres em Javacript 
    



    include '../components/profile_content.php';
    // O script AJAX que permite publicar o post está em: ./scripts/newpost.js
    // Optámos por este método para submeter dados sem sair da mesma página e para mostrar o novo post imediatamente, juntamente com outros
        
    // Falta:  
    // 1) Impedir o utilizador de publicar um post vazio ou com mais do que 255 caracteres em Javacript (client side) e PHP (server side)
    // 2) Adicionar a funcionalidade de Lazy loading em JQuery/AJAX/PHP para carregar mais posts em tempo real
    // 3) Modificar os contadores (Posts, Favoritos, Seguindo e Seguidores) para actualizarem em tempo real (JQuery/AJAX/PHP)
    // 4) Secção de Favoritos, Seguindo e Seguidores na mesma página

    // include 'footer.php'

    ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../scripts/newpost.js"></script>
</body>
</html>