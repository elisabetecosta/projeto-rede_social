<div class="profile-content profile-main">
        <div class="profile-wrapper">

            <!-- Coluna lateral (Sobre mim e Galeria) -->
            <span class="sidebar-col">
                <div class="sidebar-box">
                    <h3><?php echo $user_title; ?></h3>
                    <!-- Descrição de perfil escrita pelo utilizador -->
                    <p><?php echo $user_desc; ?></p>
                </div>
                <div class="sidebar-box">
                    <h3><?php echo $gallerytitle ?></h3> 
                    <!-- Mostra as 4 fotografias mais recentes do utilizador com sessão iniciada -->
                    <?php foreach ($displayMedia as $row) { print "<img src='../users/". $handle ."/media/" .$row['content']. "'>"; } ?>
                </div>
            </span>

            <!-- Coluna dos posts (Criar novo post + últimos 10 posts) -->
            <span class="posts-col">
                <div class="post-box">
                    <span class="user-frame">
                        <a href="#"><img class="avatar" src='../users/<?php echo $handle; ?>/<?php echo $avatar; ?>' /></a>
                    </span>
                    <span class="post-frame">
                        <h3>Nova publicação</h3>
                        <form id="newpost_box" method="POST" action="publish.php">
                            <textarea name="newpost-text" class="newpost_text" id="newpost_text"></textarea>
                            <input class="btn right" type="submit" value="Publicar" />
                        </form>
                    <span>
                </div>

            <?php foreach ($displayPosts as $row) {
                    echo "<div class='post-box'>";
                    echo "<span class='user-frame'>";
                    echo    "<a href='#'><img class='avatar' src='../users/" . $handle . "/" . $avatar . "' /></a>";
                    echo "</span>";
                    echo "<span class='post-frame'>";
                    echo    "<a class='btn-edit-link' href='#'><span class='btn-edit'><svg width='4.856' height='20.892' viewBox='0 0 1.285 5.528' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path style='fill:#808a99;fill-opacity:1;stroke-width:.0672245;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke markers fill' d='M1.285.642a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 .642.642.642 0 0 1 .642 0a.642.642 0 0 1 .643.642zM1.285 2.764a.642.642 0 0 1-.643.642A.642.642 0 0 1 0 2.764a.642.642 0 0 1 .642-.643.642.642 0 0 1 .643.643zM1.285 4.885a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 4.885a.642.642 0 0 1 .642-.642.642.642 0 0 1 .643.642z'/></svg></span></a>";
                    echo    "<h3>" . $name . "</h3>";
                    echo    "<h4 class='timestamp'>" . $handle . " &bull; " . time_elapsed_string($row['date']) . "</h4>";
                    echo    "<p>" . $row['text'] . "</p>";
                    echo "</span>";
                    echo "</div>";
                };
                ?>
            </span>
        </div>
    </div>
<!--     <div class="post-options">
        <input value="Editar">
        <input value="Afixar">
        <input value="Copiar">
        <input value="Eliminar">
    </div> -->

</main>