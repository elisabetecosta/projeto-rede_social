    <div class="profile-content profile-main">
        <div class="profile-wrapper">
            <div class="users-col">
                <div class="users-row">
                    <?php
                    $i = 1;
                    foreach($displayFollowing as $row){
                        echo "<div class='user-box'>";
                        echo    "<span class='user-frame'>";
                        echo        "<a href='#'><img class='avatar' src='../users/". $row['handle'] ."/". $row['avatar'] ."' /></a>";
                        echo    "</span>";
                        echo    "<span class='profile-frame'>";
                        echo    "<h3>". $row['name'] ."</h3>";
                        echo    "<h4 class='timestamp'> @". $row['handle'] ."</h4>";
                        echo    "<p>". $row['desc'] ."</p>";
                        echo    "</span>";
                        echo        "<span class='right'>";
                        echo        "<input class='target' id='dropdown-menu". $i ."' type='checkbox'>";
                        echo            "<label onclick='dropdown()' class='btn-dropdown-menu right' for='dropdown-menu". $i ."'><svg width='4.856' height='20.892' viewBox='0 0 1.285 5.528' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path style='fill:#808a99;fill-opacity:1;stroke-width:.0672245;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke markers fill' d='M1.285.642a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 .642.642.642 0 0 1 .642 0a.642.642 0 0 1 .643.642zM1.285 2.764a.642.642 0 0 1-.643.642A.642.642 0 0 1 0 2.764a.642.642 0 0 1 .642-.643.642.642 0 0 1 .643.643zM1.285 4.885a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 4.885a.642.642 0 0 1 .642-.642.642.642 0 0 1 .643.642z'/></svg></label>";
                        echo            "<span class='options dropdown-menu'>";
                        echo                "<input class='li' type='button' data-id='123' value='Remover'>";
                        echo                "<input class='li' type='button' data-id='123' value='Bloquear'>";
                        echo                "<input class='li' type='button' data-id='123' value='Denunciar'>";
                        echo            "</span>";
                        echo        "</span>";
                        echo "</div>";
                        $i+=1;
                    };
                    ?>
                </div>


<!--            <div class="user-box">
                <span class='user-frame'>
                    <a href='#'><img class='avatar' src='../users/rayana/avatar.png' /></a>
                </span>
                <span class='profile-frame'>
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
                <h4 class='timestamp'> @rayana</h4>
                <p>Pinguins são interessantes mas a nossa foca é infinitamente mais interessante e bela do que o Tux. Quem discorda, não passa de um ignorante.</p>
                </span>
                </div> -->
            </div>
        </div>
    </div>
</main>