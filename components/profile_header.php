<main class="profile-container">
    <div class="profile-cover">
        <img src='../users/<?php echo $handle; ?>/<?php echo $cover; ?>' />
    </div>

    <div class="profile-content profile-info">
        <div class="profile-wrapper">
            <span class="profile-avatar">
                <a href="profile.php"><img src='../users/<?php echo $handle; ?>/<?php echo $avatar ?>' /></a></span>
            <span class="profile-name">
                <!-- Nome do Utilizador -->
                <h2><?php echo $name; ?></a></h2>
                <!-- @handle do utilizador -->
                <h4>@<?php echo $handle; ?></h4>
            </span>
            <span class="profile-stats">
            <!-- Estatísticas do utilizador: número de posts, número de favoritos, número de pessoas que segue, número de seguidores -->
                <span class="stats-posts"><h3>Publicações</h3> <a href="../server/posts.php"><?php echo $posts; ?></a></span>
                <span class="stats-faves"><h3>Favoritos</h3> <a href="../server/favorites.php"><?php echo $faves; ?></a></span>
                <span class="stats-following"><h3>Seguindo</h3> <a href="../server/following.php"><?php echo $following; ?></a></span>
                <span class="stats-followers"><h3>Seguidores</h3> <a href="../server/followers.php"><?php echo $followers; ?></a></span>
            </span>
            <span class="profile-btn-container">
                <button class="btn">Editar</button>
            </span>
        </div>
    </div>
