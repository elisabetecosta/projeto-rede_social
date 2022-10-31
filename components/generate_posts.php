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
                
<!-- // POST-MODELO PARA AJUDAR A CRIAR O FOREACH ABAIXO // -->
<!--                 <div class='post-box'>
                    <span class='user-frame'>
                        <a href='#'><img class='avatar' src='../users/rayana/avatar.png' /></a>
                    </span>
                    <span class='post-frame'>
                        <span class='right'>
                        <input class='target' id='dropdown-menu' type='checkbox'>
                            <label class="btn-dropdown-menu right" for='dropdown-menu'><svg width='4.856' height='20.892' viewBox='0 0 1.285 5.528' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path style='fill:#808a99;fill-opacity:1;stroke-width:.0672245;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke markers fill' d='M1.285.642a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 .642.642.642 0 0 1 .642 0a.642.642 0 0 1 .643.642zM1.285 2.764a.642.642 0 0 1-.643.642A.642.642 0 0 1 0 2.764a.642.642 0 0 1 .642-.643.642.642 0 0 1 .643.643zM1.285 4.885a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 4.885a.642.642 0 0 1 .642-.642.642.642 0 0 1 .643.642z'/></svg></label>
                            <span class="options dropdown-menu">
                                <input class='li' type='button' data-id='123' value='Editar'>
                                <input class='li' type='button' data-id='123' value='Afixar'>
                                <input class='li' type='button' data-id='123' value='Copiar'>
                                <input class='li' type='button' data-id='123' value='Eliminar'>
                            </span>
                        </span>
                        <h3>Teste</h3>
                        <h4 class='timestamp'> @rayana &bull; 3 segs</h4>
                        <p>Teste</p>
                    </span>
                </div>  -->

            <?php
                $i = 1; //Para ligar cada label à sua respectiva checkbox (dropdown-menu1, dropdown-menu2, dropdown-menu3...)
                foreach ($displayPosts as $row) {
                    echo "<div class='post-box'>";
                    echo "<span class='user-frame'>";
                    echo    "<a href='#'><img class='avatar' src='../users/" . $handle . "/" . $avatar . "' /></a>";
                    echo "</span>";
                    echo "<span class='post-frame'>";
                    echo    "<span class='right'>";
                    echo        "<input class='target' id='dropdown-menu". $i ."' type='checkbox'>";
                    echo        "<label class='btn-dropdown-menu right' for='dropdown-menu". $i ."'><svg width='4.856' height='20.892' viewBox='0 0 1.285 5.528' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path style='fill:#808a99;fill-opacity:1;stroke-width:.0672245;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke markers fill' d='M1.285.642a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 .642.642.642 0 0 1 .642 0a.642.642 0 0 1 .643.642zM1.285 2.764a.642.642 0 0 1-.643.642A.642.642 0 0 1 0 2.764a.642.642 0 0 1 .642-.643.642.642 0 0 1 .643.643zM1.285 4.885a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 4.885a.642.642 0 0 1 .642-.642.642.642 0 0 1 .643.642z'/></svg></label>";
                    echo        "<span class='options dropdown-menu'>";
                    echo            "<input class='li' type='button' data-id='" .$row['post_id']. "' value='Editar'>";
                    echo            "<input class='li' type='button' data-id='" .$row['post_id']. "' value='Afixar'>";
                    echo            "<input class='li' type='button' data-id='" .$row['post_id']. "' value='Copiar URL'>";
                    echo            "<input class='li' type='button' data-id='" .$row['post_id']. "' value='Eliminar'>";
                    echo        "</span>";
                    echo    "</span>";
                    echo    "<h3>" . $name . "</h3>";
                    echo    "<h4 class='timestamp'>" . $handle . " &bull; " . time_elapsed_string($row['date']) . "</h4>";
                    echo    "<p>" . $row['text'] . "</p>";
                    echo "</span>";
                    echo "</div>";
                    $i+=1;
                };
            ?>
            </span>
        </div>
    </div>
</main>