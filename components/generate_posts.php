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
                        <p>Pinguins são interessantes mas a nossa foca é infinitamente mais interessante e bela do que o Tux. Quem discorda, não passa de um ignorante.</p>
                        <div class='post-interaction'>
                            <span class='post-reply'><svg id='reply-icon' width='19.219' height='17.366' viewBox='0 0 5.085 4.595' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path d='M4.134 4.827a1.447 1.447 0 0 1-.685-.321l-.126-.11-.577-.01a2.711 2.711 0 0 1-1.718-.527C.64 3.563.36 3.174.248 2.748-.034 1.658.813.564 2.149.294 2.506.22 3.18.238 3.519.328c.369.098.849.358 1.109.6.45.42.651.851.651 1.394 0 .534-.2.969-.633 1.38-.157.147-.211.222-.195.266.031.086.214.355.355.521.13.156.149.25.055.3-.097.05-.504.072-.727.038z" transform="translate(-.194 -.249)'/></svg> 4</span>
                            <span class='reply-icon'><svg id='fave-icon' width='20.495' height='19.946' viewBox='0 0 5.423 5.277' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path d='M1.258 5.376c-.046-.046-.083-.12-.083-.163 0-.044.06-.393.136-.777.074-.383.136-.748.136-.81 0-.099-.044-.154-.366-.459-.929-.878-.945-.9-.799-1.08.056-.069.14-.086.877-.177.62-.076.83-.114.874-.158.031-.03.197-.37.369-.755.171-.384.343-.725.38-.758a.23.23 0 0 1 .323.017c.037.042.212.397.389.788.214.476.343.722.389.742.037.017.415.073.84.125.857.104.914.125.914.334 0 .133-.002.135-.69.779-.275.258-.51.497-.52.53-.011.034.05.422.136.862.126.65.148.815.117.884-.036.078-.158.16-.24.16-.02 0-.346-.177-.724-.392-.41-.234-.724-.392-.78-.392-.054 0-.37.158-.78.392-.378.215-.716.391-.75.391-.036 0-.102-.037-.148-.083z' transform='translate(-.214 -.182)'/></svg> 4</span>
                        </div>
                    </span>
                </div>  -->

            <?php
                $i = 1; //Para ligar cada label à sua respectiva checkbox (dropdown-menu1, dropdown-menu2, dropdown-menu3...)
                foreach ($displayPosts as $row) {
                    $faves =  count_post_faves($row['post_id']);
                    $replies = count_post_comments($row['post_id']);
                    echo "<div class='post-box'>";
                    echo "<span class='user-frame'>";
                    echo    "<a href='#'><img class='avatar' src='../users/" . $handle . "/" . $avatar . "' /></a>";
                    echo "</span>";
                    echo "<span class='post-frame'>";
                    echo    "<span class='right'>";
                    echo        "<input class='target' id='dropdown-menu". $i ."' type='checkbox'>";
                    echo        "<label class='btn-dropdown-menu right' for='dropdown-menu". $i ."'><svg width='4.856' height='20.892' viewBox='0 0 1.285 5.528' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path style='fill:#808a99;fill-opacity:1;stroke-width:.0672245;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke markers fill' d='M1.285.642a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 .642.642.642 0 0 1 .642 0a.642.642 0 0 1 .643.642zM1.285 2.764a.642.642 0 0 1-.643.642A.642.642 0 0 1 0 2.764a.642.642 0 0 1 .642-.643.642.642 0 0 1 .643.643zM1.285 4.885a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 4.885a.642.642 0 0 1 .642-.642.642.642 0 0 1 .643.642z'/></svg></label>";
                    echo        "<span class='options dropdown-menu'>";
                    echo            "<input class='li' type='button' data-id='" . $row['post_id'] . "' value='Editar'>";
                    echo            "<input class='li' type='button' data-id='" . $row['post_id'] . "' value='Afixar'>";
                    echo            "<input class='li' type='button' data-id='" . $row['post_id'] . "' value='Copiar URL'>";
                    echo            "<input class='li' type='button' data-id='" . $row['post_id'] . "' value='Eliminar'>";
                    echo        "</span>";
                    echo    "</span>";
                    echo    "<h3>" . $name . "</h3>";
                    echo    "<h4 class='timestamp'>" . $handle . " &bull; " . time_elapsed_string($row['date']) . "</h4>";
                    echo    "<p>" . $row['text'] . "</p>";
                    echo "<div class='post-interaction'>";
                    echo    "<span class='reply-icon'><svg id='reply-icon' width='19.219' height='17.366' viewBox='0 0 5.085 4.595' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path d='M4.134 4.827a1.447 1.447 0 0 1-.685-.321l-.126-.11-.577-.01a2.711 2.711 0 0 1-1.718-.527C.64 3.563.36 3.174.248 2.748-.034 1.658.813.564 2.149.294 2.506.22 3.18.238 3.519.328c.369.098.849.358 1.109.6.45.42.651.851.651 1.394 0 .534-.2.969-.633 1.38-.157.147-.211.222-.195.266.031.086.214.355.355.521.13.156.149.25.055.3-.097.05-.504.072-.727.038z' transform='translate(-.194 -.249)'/></svg> " . $replies['postreplies'] ."</span>";
                    echo    "<span class='fave-icon'><svg id='fave-icon' width='20.495' height='19.946' viewBox='0 0 5.423 5.277' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path d='M1.258 5.376c-.046-.046-.083-.12-.083-.163 0-.044.06-.393.136-.777.074-.383.136-.748.136-.81 0-.099-.044-.154-.366-.459-.929-.878-.945-.9-.799-1.08.056-.069.14-.086.877-.177.62-.076.83-.114.874-.158.031-.03.197-.37.369-.755.171-.384.343-.725.38-.758a.23.23 0 0 1 .323.017c.037.042.212.397.389.788.214.476.343.722.389.742.037.017.415.073.84.125.857.104.914.125.914.334 0 .133-.002.135-.69.779-.275.258-.51.497-.52.53-.011.034.05.422.136.862.126.65.148.815.117.884-.036.078-.158.16-.24.16-.02 0-.346-.177-.724-.392-.41-.234-.724-.392-.78-.392-.054 0-.37.158-.78.392-.378.215-.716.391-.75.391-.036 0-.102-.037-.148-.083z' transform='translate(-.214 -.182)'/></svg> " . $faves['postfaves'] ."</span>";
                    echo    "<span class='share-icon'><svg id='share-icon' width='26' height='18' viewBox='0 0 26 18' xmlns='http://www.w3.org/2000/svg'><path d='M13.62 3.76103L11.546 1.24674C11.277 0.920628 11.5081 0.428571 11.9308 0.428571H21.4704C22.0502 0.428571 22.2555 0.885714 22.2857 1.11429V10.3857C22.2857 10.6619 22.5096 10.8857 22.7857 10.8857H24.9475C25.3689 10.8857 25.6013 11.375 25.3351 11.7016L20.5927 17.5207C20.3917 17.7674 20.0143 17.7659 19.8151 17.5177L15.1469 11.6986C14.8843 11.3713 15.1173 10.8857 15.5369 10.8857H17.4373C17.7134 10.8857 17.9373 10.6619 17.9373 10.3857V4.44286C17.9373 4.16672 17.7134 3.94286 17.4373 3.94286H14.0058C13.8565 3.94286 13.715 3.87617 13.62 3.76103Z'/><path d='M11.1312 6.13148L6.61859 0.461985C6.42613 0.220182 6.06258 0.209138 5.8558 0.438814L0.751372 6.10831C0.461699 6.43005 0.69003 6.94286 1.12296 6.94286H3.66194C3.94015 6.94286 4.16485 7.16859 4.16213 7.44679C4.13271 10.4467 4.09881 15.8077 4.16725 16.7143C4.23507 17.6127 4.88997 17.6803 5.27074 17.5917C5.32043 17.5801 5.37091 17.5714 5.42193 17.5714H14.1953C14.6117 17.5714 14.8457 17.0922 14.5896 16.7639L12.5613 14.1639C12.4665 14.0424 12.3211 13.9714 12.1671 13.9714H8.74391C8.46777 13.9714 8.24391 13.7476 8.24391 13.4714V7.44286C8.24391 7.16672 8.46777 6.94286 8.74391 6.94286H10.74C11.1587 6.94286 11.3919 6.45906 11.1312 6.13148Z'/></svg> [por fazer]</span>";
                    echo "</div>";
                    /* echo    "<p>Post #" . $row['post_id'] . "</p>"; */
                    echo "</span>";
                    echo "</div>";
                    $i+=1;
                };
            ?>
            </span>
        </div>
    </div>
</main>