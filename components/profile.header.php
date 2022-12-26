<main class="profile-container">
    <div class="profile-cover">
        <img src='../users/<?php echo "{$userProfile->userData['handle']}"; ?>/<?php echo "{$userProfile->userData['cover']}"; ?>' />
    </div>

    <div class="profile-content profile-info">
        <div class="profile-wrapper">
            <span class="profile-avatar">
                <a href="posts"><img src='../users/<?php echo "{$userProfile->userData['handle']}"; ?>/<?php echo "{$userProfile->userData['avatar']}"; ?>' /></a></span>
            <span class="profile-name">
                <!-- Nome do Utilizador -->
                <h2><a href="posts"><?php echo "{$userProfile->userData['name']}"; ?></a></h2>
                <!-- @handle do utilizador -->
                <h4>@<?php echo "{$userProfile->userData['handle']}"; ?></h4>
            </span>
            <span class="profile-stats">
            <!-- Estatísticas do utilizador: número de posts, número de favoritos, número de pessoas que segue, número de seguidores -->
            <a <?php echo $focusposts ?> href="./posts"><h3>Publicações</h3><span><?php echo "{$userProfile->userData['posts']}"; ?></span></a>
            <a <?php echo $focusfave ?> href="./favorites"><h3>Favoritos</h3><span><?php echo "{$userProfile->userData['faves']}"; ?></span></a>
            <a <?php echo $focusflwing ?> href="./following"><h3>Seguindo</h3><span><?php echo "{$userProfile->userData['following']}"; ?></span></a>
            <a <?php echo $focusflwers ?> href="./followers"><h3>Seguidores</h3><span><?php echo "{$userProfile->userData['followers']}"; ?></span></a>
            </span>
            <span class="profile-btn-container">
                <?php
                    if (isset($_GET['profile']) && $_GET['profile'] == $_SESSION['handle']) {     //Se for o perfil do Utilizador autenticado (sessão iniciada)
                        echo '<button class="btn">Editar</button>';
                    } else if (isset($_GET['profile']) && $_GET['profile'] != $_SESSION['handle']) {     //Se for outro perfil (visitante)
                        echo '<button class="btn">Seguir</button>';
                    }
                ?>
            </span>
        </div>
    </div>
