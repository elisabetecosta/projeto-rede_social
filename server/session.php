<?php
//============= PÁGINA PHP COM CLASSES E FUNÇÕES ========================

//Contém a session start e validação da sessão
require 'includes/validate.php';

//Classe que contém as variáveis e funções para mostrar os dados do utilizador
class User {
    var $userData = null;          //Vai conter: Handle, Nome, Avatar, Capa, Título, Descrição
    var $userGallery = null;       //Vai conter: As quatro últimas fotos do Utilizador
    var $userFavorites = null;     //Vai conter: Os últimos 10 posts favoritos do utilizador
    var $userFollowings = null;    //Vai conter: Lista das 10 últimos contas que se segue
    var $userFollowers = null;     //Vai conter: Lista dos 10 últimos seguidores

    //Função que recebe um ID de utilizador e inicializa o array $userData com os dados do mesmo: Handle, Nome, Avatar, Título e Descrição
    public function get_user_data($uid){

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Prepara e executa a query 
        $profile = $connection->prepare('SELECT users.handle, profiles.name, profiles.avatar,
                                                profiles.cover, profiles.title, profiles.desc
                                            FROM users
                                            JOIN profiles
                                            ON users.user_id = profiles.user_id
                                            WHERE users.user_id = :uid');
        $profile->bindParam(':uid', $uid);
        $profile->execute();
        $data = $profile->fetch(PDO::FETCH_ASSOC);

        //Só inicializa o array se houver dados
        if(!empty($data)) {
            $this->userData['handle'] = $data['handle']; // Handle (sem arroba @)
            $this->userData['name'] = $data['name'];     // Nome do utilizador
            $this->userData['avatar'] = $data['avatar']; // Avatar (avatar.png)
            $this->userData['cover'] = $data['cover'];   // Capa de perfil (cover.png)
            $this->userData['title'] = $data['title'];   // Título da Descrição ("Sobre mim")
            $this->userData['desc'] = $data['desc'];     // Texto da Descrição 
        } else {
            $err = "ERRO! Este utilizador não existe";
            return $err;
        }
    }

    //Função que recebe um ID de utilizador e inicializa o array $userData com o número de posts, favoritos, seguindo e seguidores do mesmo
    public function get_user_stats($uid){
        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que acede à número total de Publicações deste utilizador
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

        //Inicializa o array $userData com o número de posts (exemplo: $userData['posts'] = 5 para indicar que o utilizador tem 5 publicações)
        if(!empty($numPosts)) {
            $this->userData['posts'] = $numPosts['posts'];
        } else {
            $this->userData['posts'] = 0;
        };

        //Inicializa o array $userData com o número de favoritos (exemplo: $userData['faves'] = 7 para indicar que o utilizador tem 7 posts favoritos)
        if(!empty($numFaves)) {
            $this->userData['faves'] = $numFaves['faves'];
        } else {
            $this->userData['faves'] = 0;
        };

        //Inicializa o array $userData com o número de user de está a seguir (exemplo: $userData['following'] = 4 para indicar que o utilizador segue 4 pessoas)
        if(!empty($numFollowing)) {
            $this->userData['following'] = $numFollowing['following'];
        } else {
            $this->userData['following'] = 0;
        };

        //Inicializa o array $userData com o número de seguidores (exemplo: $userData['followers'] = 9 para indicar que o utilizador é seguido por 9 pessoas)
        if(!empty($numFollowers)) {
            $this->userData['followers'] = $numFollowers['followers'];
        } else {
            $this->userData['followers'] = 0;
        };
        //Em boa verdade, se não houver nada a contar, as queries já devolvem 0.
        //Este IF-ELSE talvez acabe por ser redundante, mas é só para garantir.
    }

    //Função que recebe um ID de utilizador e inicializa o array $userGallery metendo lá dentro as últimas 4 imagens carregadas pelo utilizador
    public function get_user_gallery($uid){

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que vai buscar as últimas 4 imagens publicadas por este utilizador
        $getImages = $connection->prepare("SELECT media.content, posts.post_id
                                          FROM media
                                          JOIN posts ON media.post_id=posts.post_id
                                          WHERE posts.user_id = :uid AND posts.status=0 AND media.status=0 AND media.type = 'pic'
                                          ORDER BY media.content ASC LIMIT 4");
        $getImages->bindParam(':uid', $uid);
        $getImages->execute();
        $displayImages = $getImages->fetchAll(PDO::FETCH_ASSOC);

        //Inicializa o array $userGallery com o resultado da query anterior
        if(!empty($displayImages)){
            $this->userGallery = $displayImages;
        } else {
            $this->userGallery = null;      //Se não houver fotografias a mostrar, a galeria não aparece.
        }
    }    

    //Função que mostra as últimas 10 publicações favoritas de um utilizador
    public function get_favorited_posts($uid){

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que vai buscar os últimos 10 posts favoritos deste utilizador
        $getFaves =  $connection->prepare("SELECT profiles.name, profiles.avatar, favs.post_id,
                                                posts.text, posts.date, users.handle
                                                FROM profiles
                                                JOIN posts ON profiles.user_id=posts.user_id
                                                JOIN users ON profiles.user_id=users.user_id
                                                JOIN favs ON posts.post_id=favs.post_id
                                                WHERE favs.user_id = :uid AND favs.status = 1
                                                ORDER BY posts.post_id DESC LIMIT 10");
        $getFaves->bindParam(':uid', $uid);
        $getFaves->execute();
        $displayFavedPosts = $getFaves->fetchAll(PDO::FETCH_ASSOC);

        //Inicializa o array $userFavorites com o resultado da query
        if(!empty($displayFavedPosts)){
            $this->userFavorites = $displayFavedPosts;
        } else {
            $this->userFavorites = null;        //Se o utilizador não tiver favoritado nenhuma publicação
        }
    }

    //Função que recebe o ID de um utilizador e devolve um array de strings com todas as contas que segue
    public function display_followings($uid) {

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que vai buscar as contas que este utilizador segue
        $getFollowing =  $connection->prepare("SELECT users.handle, profiles.name, profiles.avatar, profiles.desc
                                               FROM users
                                               JOIN profiles ON users.user_id = profiles.user_id
                                               JOIN follows ON users.user_id=follows.followed_id
                                               WHERE follows.follower_id = :uid");
        $getFollowing->bindParam(':uid', $uid);
        $getFollowing->execute();
        $displayFollowing = $getFollowing->fetchAll(PDO::FETCH_ASSOC);

        //Inicializa o array $userFollowings com o resultado da query
        if(!empty($displayFollowing)){
            $this->userFollowings = $displayFollowing;
        } else {
            $this->userFollowings = null;    //Se o utilizador não seguir ninguém, mostrará uma mensagem no HTML
        }
    }

    //Função que recebe o ID de um utilizador e devolve um array de strings com os seus seguidores 
    public function display_followers($uid) {

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que vai buscar os seguidores deste utilizador
        $getFollowers =  $connection->prepare("SELECT users.handle, profiles.name, profiles.avatar, profiles.desc
                                            FROM users
                                            JOIN profiles ON users.user_id = profiles.user_id
                                            JOIN follows ON users.user_id=follows.follower_id
                                            WHERE follows.followed_id = :uid");
        $getFollowers->bindParam(':uid', $uid);
        $getFollowers->execute();
        $displayFollowers = $getFollowers->fetchAll(PDO::FETCH_ASSOC);

        //Inicializa o array $userFollowers com o resultado da query
        if(!empty($displayFollowers)){
            $this->userFollowers = $displayFollowers;
        } else {
            $this->userFollowers = null;    //Se o utilizador não for seguido por ninguém, aparecerá uma mensagem no HTML
        }
    }
}

//Classe que contém as variáveis e funções para mostrar os dados relativos a posts
class Posts {
    var $posts;
    var $favourites;
    var $replies;
    var $pictures;

    //Função que recebe um ID de utilizador e devolve um array com os seus 10 posts mais recentes + indicação se contém média
    public function get_user_posts($uid){

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que recebe os dados dos posts: post_id, texto, data de publicação, e média anexada (se não tiver, é null)
        $getPosts =  $connection->prepare("SELECT posts.post_id, posts.text, posts.date, media.type, media.content
                                           FROM posts
                                           LEFT JOIN media ON media.post_id=posts.post_id
                                           WHERE posts.user_id = :uid AND posts.status = 0
                                           GROUP BY posts.post_id
                                           ORDER BY posts.date DESC LIMIT 10");
        $getPosts->bindParam(':uid', $uid);
        $getPosts->execute();
        $tenPosts = $getPosts->fetchAll(PDO::FETCH_ASSOC);

        //Inicializa o array $posts com o resultado da query
        if(!empty($tenPosts)){
            $this->posts = $tenPosts;
        } else {
            $this->posts = null;    //Se não houver nenhum post, é null. Aparecerá uma mensagem a indicá-lo no html
        }
    }  

    //Função que recebe o ID de um post e conta todos os favoritos que recebeu //SELECT COUNT(fav_id) FROM favs WHERE post_id = :post_id AND status != 0;
    public function count_post_faves($post_id) {

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que vai buscar o número de favoritos de um post em específico
        $countPostFaves =  $connection->prepare("SELECT COUNT(fav_id) AS postfaves
                                                        FROM favs
                                                        WHERE post_id = :post_id AND status = 1");
        $countPostFaves->bindParam(':post_id', $post_id);
        $countPostFaves->execute();
        $totalPostFaves = $countPostFaves->fetch(PDO::FETCH_ASSOC);

        //Inicializa o array $favourites com o resultado da query        
        if(!empty($totalPostFaves)){
            $this->favourites = $totalPostFaves;
        } else {
            $this->favourites = 0;
        }
    }

    //Função que recebe o ID de um post e conta todos os comentários que recebeu
    public function count_post_comments($post_id) {

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que vai buscar o número de comentários que um post em específico recebeu
        $countPostReplies =  $connection->prepare("SELECT COUNT(comment_id ) AS postreplies
                                                        FROM comments
                                                        WHERE post_id = :post_id AND status = 0");
        $countPostReplies->bindParam(':post_id', $post_id);
        $countPostReplies->execute();
        $totalPostReplies = $countPostReplies->fetch(PDO::FETCH_ASSOC);

        //Inicializa o array $replies com o resultado da query   
        if(!empty($totalPostReplies)){
            $this->replies = $totalPostReplies;
        } else {
            $this->replies = 0;
        }
    }

    //Função que recebe o ID do post e devolve o array de imagens (exemplo.png)
    public function get_post_images($post_id){

        //Estabelece a conexão com a base de dados
        require 'includes/connect_db.php';

        //Query que vai buscar as imagens de um post em específico
        $getImages =  $connection->prepare("SELECT content 
                                            FROM media
                                            WHERE post_id = :post_id AND status = 0");
        $getImages->bindParam(':post_id', $post_id);
        $getImages->execute();
        $displayImages = $getImages->fetchAll(PDO::FETCH_ASSOC);

        //Inicializa o array $pictures com o resultado da query   
        if(!empty($displayImages)){
            $this->pictures = $displayImages;
        } else {
            return false;
        }
    }

    //Converte o link do youtube numa versão "embed" para ser usada num <iframe> que incorpora o vídeo ao post
    public function convertYoutube($youtubeURL) {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';                                        //Link do Youtube encurtado
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';  //Link do Youtube normal
    
        //Se for o link do Youtube encurtado
        if (preg_match($longUrlRegex, $youtubeURL, $matches)) {
           $youtube_id = $matches[count($matches) - 1];
        }
        //Se for o link do Youtube normal ou "longo"
        if (preg_match($shortUrlRegex, $youtubeURL, $matches)) {
           $youtube_id = $matches[count($matches) - 1];
        }

        //Devolve um link preparado para ser usado no html com a markup <iframe>
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }
}

//Classe para preencher o corpo do HTML de acordo com as preferências do utilizador (por enquanto, estou a inicializar tudo hardcoded)
class Settings {
    //Links da barra de navegação superior [navbar.php]:
    var $homeURL = "posts.php";                         //link do logotipo XATA
    var $profileURL = "../server/posts.php";            //link do avatar do user (avatar pequenino)
    var $notifsURL = "notifications.php";               //link do icone de notificações (sineta)
    var $configURL = "settings.php";                    //link do ícone de configurações (roda dentada)
    var $logoutURL = "logout.php";                      //link do botão de logout

    //Configurações do cabeçalho do HTML [head.php]
    var $language = "pt-PT";                            //linguagem escolhida pelo utilizador
    var $charset = "UTF-8";                             
    var $metaTags = "xata, perfil, rede social";        //palavras-chave para motores de busca
}

//Função que recebe a datahora armazenada no sistema e devolve uma string com o tempo relativo (exemplo: "há 5 segs")
//Não estou a meter esta função em nenhuma classe para já
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

//Crio um objecto para preencher o corpo do HTML de acordo com as preferências do utilizador //Para imprimir as variáveis desta classe, usar: echo $userSettings->homeURL;
$userSettings = new Settings();                         //Inicializa as variáveis do head.php            

//Crio um objecto User para o utilizador que iniciou sessão //Para imprimir as variáveis destas funções, usar: echo $userProfile->userData['handle'];
$userProfile = new User();                              
$userProfile->get_user_data($_SESSION['user_id']);      //Inicializa as variáveis do navbar.php


//Para fazer DEBUG, removo todo o html e executo apenas a variável que quero testar:
/*  echo "<pre>";
        var_dump($userProfile->userData);
    echo "</pre>";
*/