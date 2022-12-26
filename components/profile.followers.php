<div class="profile-content profile-main">
        <div class="profile-wrapper">
            <div class="users-col">
                <div class="users-row">
                    <?php
                    if(!empty($userProfile->userFollowers)){
                        $index = 1;
                        foreach($userProfile->userFollowers as $row){
                            echo "<div class='user-box'>";
                            echo    "<span class='user-frame'>";
                            echo        "<a href='../". $row['handle'] ."/'><img class='avatar' src='../users/". $row['handle'] ."/". $row['avatar'] ."' /></a>";
                            echo    "</span>";
                            echo    "<span class='profile-frame'>";
                            echo    "<h3><a href='../". $row['handle'] ."/'>". $row['name'] ."</a></h3>";
                            echo    "<h4 class='timestamp'> @". $row['handle'] ."</h4>";
                            echo    "<p>". $row['desc'] ."</p>";
                            echo    "</span>";
                            echo        "<span class='right'>";
                            echo        "<input class='target' id='dropdown-menu". $index ."' type='checkbox'>";
                            echo            "<label onclick='dropdown()' class='btn-dropdown-menu right' for='dropdown-menu". $index ."'><svg width='4.856' height='20.892' viewBox='0 0 1.285 5.528' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path style='fill:#808a99;fill-opacity:1;stroke-width:.0672245;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke markers fill' d='M1.285.642a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 .642.642.642 0 0 1 .642 0a.642.642 0 0 1 .643.642zM1.285 2.764a.642.642 0 0 1-.643.642A.642.642 0 0 1 0 2.764a.642.642 0 0 1 .642-.643.642.642 0 0 1 .643.643zM1.285 4.885a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 4.885a.642.642 0 0 1 .642-.642.642.642 0 0 1 .643.642z'/></svg></label>";
                            echo            "<span class='options dropdown-menu'>";
                            if(isset($_GET['profile']) && $_GET['profile'] == $_SESSION['handle']) {
                            echo                "<input class='li' type='button' data-id='123' value='Remover'>";
                            echo                "<input class='li' type='button' data-id='123' value='Bloquear'>";
                            echo                "<input class='li' type='button' data-id='123' value='Denunciar'>";
                            } else if(isset($_GET['profile']) && $_GET['profile'] != $_SESSION['handle']) {
                            echo                "<input class='li' type='button' data-id='123' value='Seguir'>";
                            echo                "<input class='li' type='button' data-id='123' value='Bloquear'>";
                            echo                "<input class='li' type='button' data-id='123' value='Denunciar'>";
                            }
                            echo            "</span>";
                            echo        "</span>";
                            echo "</div>";
                            $index+=1;
                        };
                    } else {
                        echo "<div class='user-box'>";
                        echo "<p>Ninguém gosta de ti. Temos pena!</p>";
                        echo "</div>";
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>