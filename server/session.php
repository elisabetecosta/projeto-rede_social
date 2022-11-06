<?php
//Contém a session start e validação da sessão
include 'includes/validate.php';

//Estabelece a conexão com a base de dados
include_once 'includes/connect_db.php';

//============== FUNÇÕES COM QUERIES PARA IR BUSCAR OS DADOS =================
//Função que recebe um ID de utilizador e devolve um array de strings: handle, name, avatar, cover, title, desc
    function get_user_data($uid){
        require 'includes/connect_db.php';
        $a = array();
        $profile = $connection->prepare('SELECT users.handle, profiles.name, profiles.avatar,
                                                profiles.cover, profiles.title, profiles.desc
                                            FROM users
                                            JOIN profiles
                                            ON users.user_id = profiles.user_id
                                            WHERE users.user_id = :uid');
        $profile->bindParam(':uid', $uid);
        $profile->execute();
        $data = $profile->fetch(PDO::FETCH_ASSOC);

        if(!empty($data)) {
                $a['handle'] = $data['handle']; // Handle (sem arroba @)
                $a['name'] = $data['name'];     // Nome do utilizador
                $a['avatar'] = $data['avatar']; // Avatar (avatar.png)
                $a['cover'] = $data['cover'];   // Capa de perfil (cover.png)
                $a['title'] = $data['title'];   // Título da Descrição ("Sobre mim")
                $a['desc'] = $data['desc'];     // Texto da Descrição 
        }
        return $a;
    }

//Função que recebe um ID de utilizador e devolve um array com o número de: posts, favoritos, seguindo e seguidores
    function get_user_stats($uid){
        require 'includes/connect_db.php';
        $a = array();
        //Query que acede ao número total de Publicações deste utilizador
        $countPosts = $connection->prepare('SELECT COUNT(post_id)
                                            AS posts
                                            FROM posts
                                            WHERE user_id = :uid');
        $countPosts->bindParam(':uid', $uid);
        $countPosts->execute();
        $numPosts = $countPosts->fetch(PDO::FETCH_ASSOC);

        //Query que acede ao número total de Favoritos deste utilizador
        $countFaves = $connection->prepare('SELECT COUNT(fav_id)
                                            AS faves
                                            FROM favs
                                            WHERE user_id = :uid AND NOT status = 0' ); //Se o utilizador se "arrepender" de favoritar algo, o status passa a 0, logo temos de exclui-los do contador (sem eliminar o registo em si mesmo)
        $countFaves->bindParam(':uid', $uid);
        $countFaves->execute();
        $numFaves = $countFaves->fetch(PDO::FETCH_ASSOC);

        //Query que acede ao número total contas que este utilizador segue
        $countFollowing = $connection->prepare('SELECT COUNT(follow_id)
                                            AS following
                                            FROM follows
                                            WHERE follower_id = :uid');
        $countFollowing->bindParam(':uid', $uid);
        $countFollowing->execute();
        $numFollowing = $countFollowing->fetch(PDO::FETCH_ASSOC);

        //Query que acede ao número total de contas que seguem este utilizador
        $countFollowers = $connection->prepare('SELECT COUNT(follow_id) AS followers FROM follows WHERE followed_id = :uid');
        $countFollowers->bindParam(':uid', $uid);
        $countFollowers->execute();
        $numFollowers = $countFollowers->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($numPosts) && !empty($numFaves) &&
           !empty($numFollowing) && !empty($numFollowers)) {
            $a['posts'] = $numPosts['posts'];
            $a['faves'] = $numFaves['faves'];
            $a['following'] = $numFollowing['following'];
            $a['followers'] = $numFollowers['followers'];
        }

        return $a;
    }

//Função que recebe um ID de utilizador e devolve um array com a galeria do utilizador
    function get_user_gallery($uid){
        require 'includes/connect_db.php';
        $a = array();
        //Carrega apenas as últimas 4 imagens publicadas por este utilizador (usamos a data de publicação/actualização da tabela posts)
        $getMedia = $connection->prepare("SELECT media.content, posts.post_id
                                          FROM media
                                          JOIN posts
                                          ON media.post_id=posts.post_id
                                          WHERE posts.user_id = :uid AND posts.status=0 AND media.status=0
                                          ORDER BY media.content ASC LIMIT 4");
        $getMedia->bindParam(':uid', $uid);
        $getMedia->execute();
        $displayMedia = $getMedia->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($displayMedia)){
            $a = $displayMedia;
        }
        return $a;
    }

//Função que recebe um ID de utilizador e devolve um array com os seus 10 posts mais recentes
    function get_user_posts($uid){
        require 'includes/connect_db.php';
        $getPosts =  $connection->prepare("SELECT post_id, text, date
                                           FROM posts
                                           WHERE user_id = :uid AND status = 0 
                                           ORDER BY date DESC LIMIT 10");
        $getPosts->bindParam(':uid', $uid);
        $getPosts->execute();
        $displayPosts = $getPosts->fetchAll(PDO::FETCH_ASSOC);
        $a = $displayPosts;
        return $a;
    }

//Função que mostra todos os favoritos de um utilizador
//SELECT favs.user_id, favs.fav_id, profiles.name, profiles.avatar, favs.post_id, posts.text, posts.date, users.handle, favs.status FROM profiles JOIN posts ON profiles.user_id=posts.user_id JOIN users ON profiles.user_id=users.user_id JOIN favs ON posts.post_id=favs.post_id WHERE favs.user_id = 3 ORDER BY posts.post_id;
function get_favorited_post($uid){
    require 'includes/connect_db.php';
    $getFaves =  $connection->prepare("SELECT profiles.name, profiles.avatar, favs.post_id,
                                            posts.text, posts.date, users.handle
                                            FROM profiles
                                            JOIN posts ON profiles.user_id=posts.user_id
                                            JOIN users ON profiles.user_id=users.user_id
                                            JOIN favs ON posts.post_id=favs.post_id
                                            WHERE favs.user_id = :uid AND favs.status = 1 ORDER BY posts.post_id DESC;");
    $getFaves->bindParam(':uid', $uid);
    $getFaves->execute();
    $displayFavedPosts = $getFaves->fetchAll(PDO::FETCH_ASSOC);
    return $displayFavedPosts;
}
// Nota para mim:
// Para seleccionar todos os favoritos (sem filtro de utilizador), usar:
// SELECT favs.fav_id, profiles.name, profiles.avatar, favs.post_id, posts.text, posts.date, users.handle, favs.status FROM profiles JOIN posts ON profiles.user_id=posts.user_id JOIN users ON profiles.user_id=users.user_id JOIN favs ON posts.post_id=favs.post_id WHERE posts.post_id ORDER BY posts.post_id;
// Isto ajuda a ter noção do que estou a selecionar


//Recebe o ID de um post e "apaga-o"
    function deletesPost($post_id){
        require 'includes/connect_db.php';
        $deletesPost = $connection->prepare("UPDATE posts
                                             SET status = 1
                                             WHERE CONCAT(posts.post_id) = :post_id; ");
        $deletesPost->bindParam(':post_id', $post_id);
        $deletesPost->execute();
    }

//Função que recebe a datahora armazenada no sistema e devolve uma string com o tempo relativo (exemplo: "há 5 segs")
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

//Função que recebe o ID de um post e conta todos os favoritos que recebeu //SELECT COUNT(fav_id) FROM favs WHERE post_id = :post_id AND status != 0;
    function count_post_faves($post_id) {
        require 'includes/connect_db.php';
        $countPostFaves =  $connection->prepare("SELECT COUNT(fav_id) AS postfaves
                                                        FROM favs
                                                        WHERE post_id = :post_id AND status = 1");
        $countPostFaves->bindParam(':post_id', $post_id);
        $countPostFaves->execute();
        $totalPostFaves = $countPostFaves->fetch(PDO::FETCH_ASSOC);
        return $totalPostFaves;
    }

//Função que recebe o ID de um post e conta todos os comentários que recebeu
    function count_post_comments($post_id) {
        require 'includes/connect_db.php';
        $countPostReplies =  $connection->prepare("SELECT COUNT(comment_id ) AS postreplies
                                                        FROM comments
                                                        WHERE post_id = :post_id AND status = 0");
        $countPostReplies->bindParam(':post_id', $post_id);
        $countPostReplies->execute();
        $totalPostReplies = $countPostReplies->fetch(PDO::FETCH_ASSOC);
        return $totalPostReplies;
    }

//Função que recebe o ID de um utilizador e devolve um array de strings com todas as contas que segue
    function display_following($uid) {
        require 'includes/connect_db.php';
        $getFollowing =  $connection->prepare("SELECT users.handle, profiles.name, profiles.avatar, profiles.desc
                                               FROM users
                                               JOIN profiles ON users.user_id = profiles.user_id
                                               JOIN follows ON users.user_id=follows.followed_id
                                               WHERE follows.follower_id = :uid");
        $getFollowing->bindParam(':uid', $uid);
        $getFollowing->execute();
        $displayFollowing = $getFollowing->fetchAll(PDO::FETCH_ASSOC);
        return $displayFollowing;
    }

//Função que recebe o ID de um utilizador e devolve um array de strings com os seus seguidores 
function display_followers($uid) {
    require 'includes/connect_db.php';
    $getFollowers =  $connection->prepare("SELECT users.handle, profiles.name, profiles.avatar, profiles.desc
                                           FROM users
                                           JOIN profiles ON users.user_id = profiles.user_id
                                           JOIN follows ON users.user_id=follows.follower_id
                                           WHERE follows.followed_id = :uid");
    $getFollowers->bindParam(':uid', $uid);
    $getFollowers->execute();
    $displayFollowers = $getFollowers->fetchAll(PDO::FETCH_ASSOC);
    return $displayFollowers;
}

//============== O PERFIL DO UTILIZADOR COMEÇA AQUI =================

//Links da barra de navegação superior [navbar.php]:
$homeURL = "main.php";                          //link do logotipo XATA
$profileURL = "../server/posts.php";            //link do avatar do user (avatar pequenino)
$notifsURL = "notifications.php";               //link do icone de notificações (sineta)
$configURL = "config.php";                      //link do ícone de configurações (roda dentada)
$logoutURL = "logout.php";                      //link do botão de logout

//Variáveis do Perfil do Utilizador [profile_header.php]:
$session = get_user_data($_SESSION['user_id']);   //Recebe um array com os índices:
$handle = $session['handle'];                   // handle
$cover = $session['cover'];                     // cover (capa)
$avatar = $session['avatar'];                   // avatar (avatar.png)
$name = $session['name'];                       // name (nome do utilizador)

//Configurações do cabeçalho do HTML [head.php]
$language = "pt-PT";
$charset = "UTF-8";
$metaTags = "xata, perfil, rede social";
$title = "$name (@$handle)";                    //Título da página = Nome do utilizador (@handle)

//Estatísticas do utilizador [profile_header.php]
$stats = get_user_stats($_SESSION['user_id']);    //Recebe um array com os índices:
$posts = $stats['posts'];                       // posts (Número de publicações)
$faves = $stats['faves'];                       // faves (Número de favoritos)
$following = $stats['following'];               // following (Número de users que seguem este user)
$followers = $stats['followers'];               // followers (Número de seguidores)

//Variáveis da coluna lateral esquerda da página de publicações do utilizador [posts.php]
$user_title = $session['title'];
$user_desc = $session['desc'];
$gallerytitle = "Galeria";
$displayMedia = get_user_gallery($_SESSION['user_id']);
$displayPosts = get_user_posts($_SESSION['user_id']);
$displayFavedPosts = get_favorited_post($_SESSION['user_id']);

$displayFollowing = display_following($_SESSION['user_id']);
$displayFollowers = display_followers($_SESSION['user_id']);
?>
