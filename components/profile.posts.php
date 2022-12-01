<div class="profile-content profile-main">
        <div class="profile-wrapper">

            <!-- Coluna lateral (Sobre mim e Galeria) -->
            <span class="sidebar-col">
                <div class="sidebar-box">
                    <h3><?="{$userProfile->userData['title']}";?></h3>
                    <!-- Descrição de perfil escrita pelo utilizador -->
                    <p><?="{$userProfile->userData['desc']}";?></p>
                </div>
                <?php //Só mostra a galeria se houver imagens a mostrar
                    if(!empty($userProfile->userGallery)) {
                        echo "<div class='sidebar-box'>";
                        echo "    <h3>Galeria</h3>";
                        // Mostra as 4 fotografias mais recentes do utilizador com sessão iniciada -->
                        echo "<div class='gallery'>";
                        foreach ($userProfile->userGallery as $row) { print "<img src='../users/{$userProfile->userData['handle']}/media/" . htmlentities($row['content']) . "'>"; }
                        echo "</div>";
                        echo "</div>";
                    }
                ?>

            </span>

            <!-- Criar Novo Post -->
            <span class="posts-col">
                <div class="fixed-box">
                    <span class="user-frame">
                        <a href="#"><img class="avatar" src='../users/<?=htmlentities("{$userProfile->userData['handle']}");?>/<?=htmlentities("{$userProfile->userData['avatar']}");?>' /></a>
                    </span>
                    <span class="post-frame">
                        <h3>Nova publicação</h3>
                        <form id="newpost_box" method="POST" action="../server/action.publish.php" enctype="multipart/form-data">
                            <textarea name="newpost-text" class="newpost_text" id="newpost_text"></textarea>

                        <!-- Mostra uma previsão do como ficará o post -->
                        <div class='picturebox preview_media'>
                            <img id='preview' class='first' src="#" alt='A carregar...' />
                        </div>

                        <!-- Botões para adicionar média ao post -->
                        <div class="media_submit">
                            <label for="uploaded_image[]" class="file_upload" title="Adicionar imagem">
                                <svg class="pic-icon" viewBox="0 0 11.167 11.167" xmlns="http://www.w3.org/2000/svg"><g style="display:inline" stroke="none"><g style="display:inline;stroke-width:1.57999;stroke-dasharray:none" transform="matrix(.25389 0 0 .25389 -1.376 -1.15)"><circle style="display:inline;fill:none;fill-opacity:1;stroke:#0092ca;stroke-width:1.57999;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:none;stroke-opacity:1;paint-order:markers fill stroke" cx="27.411" cy="26.524" r="21.202"/><path style="display:inline;fill:#0092ca;fill-opacity:1;stroke-width:1.57999;stroke-dasharray:none" d="M22.747 13.456a3.422 3.422 0 0 0-3.422 3.423 3.422 3.422 0 0 0 3.422 3.422 3.422 3.422 0 0 0 3.423-3.422 3.422 3.422 0 0 0-3.423-3.423zM36.76 23.891a1.574 1.574 0 0 0-.367.076c-.655.196-1.939 1.096-3.685 2.584-.829.706-1.762 1.422-2.075 1.592l-.567.31-.634-.22c-.348-.121-.888-.356-1.198-.523-1.095-.586-2.146-.503-3.163.25-.237.175-1.387 1.59-2.556 3.143a397.478 397.478 0 0 1-3.983 5.197 266.19 266.19 0 0 0-3.994 5.27l-.893 1.214a21.133 21.133 0 0 0 13.614 4.988 21.133 21.133 0 0 0 20.3-15.3c-1.005-.36-1.753-.867-3.103-2.019-.906-.774-2.575-2.348-3.708-3.5-2.387-2.424-2.645-2.648-3.36-2.922-.28-.106-.447-.15-.628-.14zm-21.382 4.041c-1.048.01-1.256.12-3.179 1.692-2.671 2.183-3.917 3.114-5.012 3.59a21.133 21.133 0 0 0 5.7 8.918c.228-.3.473-.628.731-.98 1.701-2.318 3.65-4.853 6.276-8.165.72-.906 1.291-1.701 1.27-1.766-.055-.173-3.558-2.581-4.315-2.966-.533-.272-.792-.329-1.471-.323z"/></g></g></svg>
                            </label>
                            <input id="uploaded_image[]" accept="image/png, image/jpg, image/gif, image/jpeg" type="file" onchange="previewMedia(this);" multiple/>
                             <!--   
                             <label> 
                            <input type="button" alt="Adicionar vídeo" name="media_options" class="media_options" value="vid" />
                                <svg id="vid" width="42.205" height="42.205" viewBox="0 0 11.167 11.167" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><g style="display:inline"><g transform="matrix(.25389 0 0 .25389 -18.065 -4.608)" style="display:inline;stroke-width:1.57999;stroke-dasharray:none"><circle style="display:inline;fill:none;fill-opacity:1;stroke:#0092ca;stroke-width:1.57999;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:none;stroke-opacity:1;paint-order:markers fill stroke" cx="93.145" cy="40.141" r="21.202"/><path style="display:inline;fill:#0092ca;fill-opacity:1;stroke:none;stroke-width:1.57999;stroke-dasharray:none;stroke-opacity:1" d="M88.996 31.154a2.09 2.09 0 0 0-.736.107c-.35.132-.697.453-.874.813l-.129.262-.014 7.673c-.015 8.474-.033 7.99.317 8.444.232.3.534.504.88.596.16.042.337.078.395.08.33.008.745-.17 1.76-.756 1.364-.786 4.892-2.824 7.518-4.342a737.984 737.984 0 0 1 2.576-1.484c1.965-1.118 2.15-1.251 2.386-1.708.295-.573.165-1.374-.3-1.853-.103-.105-1.108-.72-2.355-1.441-1.196-.692-2.447-1.415-2.78-1.609-.332-.193-1.397-.808-2.365-1.366-.97-.559-2.649-1.528-3.733-2.155-1.084-.627-2.052-1.167-2.15-1.2a1.381 1.381 0 0 0-.396-.06z"/></g></g></svg>
                            </label>

                            <label> 
                            <input type="button" alt="Adicionar Emoji" name="media_options" class="media_options" value="emoji" />
                                <svg id="emoji" width="42.205" height="42.205" viewBox="0 0 11.167 11.167" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><g style="display:inline"><g style="display:inline;stroke-width:1.57999;stroke-dasharray:none"><g transform="matrix(.54862 0 0 .54862 -33.72 -114.955)" style="display:inline;fill:#0092ca;fill-opacity:1;stroke-width:.73118;stroke-dasharray:none"><circle style="display:inline;fill:none;fill-opacity:1;stroke:#0092ca;stroke-width:1.57999;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:none;stroke-opacity:1;paint-order:markers fill stroke" cx="180.081" cy="26.23" r="21.202" transform="matrix(.46278 0 0 .46278 -11.695 207.574)"/><path style="display:inline;fill:#0092ca;fill-opacity:1;stroke-width:1.42482;stroke-dasharray:none" d="M116.097 25.234v.001a.931.931 0 0 0-.138.009c-.052-.003-.1-.009-.135-.009a.187.187 0 0 0-.05.006c-.098.504-.546 1.246-.744 1.67-.667 1.127-1.467 1.886-3.768 2.076-.578.02-1.259.055-1.965-.413-.936-.577-1.203-1.723-1.207-2.624l-.011-.625c-.175-.171-1.17.14-1.144.232-.06 1.274.206 2.824 1.293 3.745a4.003 4.003 0 0 0 2.662 1.031c1.027-.037 2.624-.129 3.87-1.216.593-.481.971-1.07 1.2-1.455.23.386.61.973 1.203 1.455 1.246 1.087 2.842 1.179 3.869 1.216a3.994 3.994 0 0 0 2.662-1.03c1.087-.922 1.354-2.472 1.293-3.746.026-.091-.969-.403-1.144-.232l-.01.625c-.004.901-.272 2.047-1.207 2.624-.707.468-1.387.433-1.966.413-2.3-.19-3.1-.949-3.768-2.076-.197-.424-.646-1.166-.743-1.67a.207.207 0 0 0-.05-.006zM107.32 14.903c-1.18-.001-2.416.553-3.224 1.195-1.157.956-1.655 2.335-1.199 3.633.286.73.88 1.189 1.632 1.425.881.163 1.779.02 2.596-.307 1.146-.452 2.344-1.299 2.786-2.397.222-.676.272-1.432.01-2.019-.285-.641-.92-1.093-1.546-1.358a3.189 3.189 0 0 0-1.055-.172zm17.275 0a3.19 3.19 0 0 0-1.055.172c-.625.265-1.26.716-1.547 1.358-.261.587-.211 1.343.01 2.019.442 1.098 1.64 1.945 2.786 2.397.817.327 1.715.47 2.597.307.752-.236 1.346-.696 1.631-1.425.456-1.298-.041-2.677-1.199-3.633-.808-.642-2.043-1.197-3.223-1.195zM114.752 22.163c.006.485.23.87.577 1.244.217.205.356.289.571.32v.012c.02-.002.039-.002.057-.006l.057.006v-.011c.216-.032.355-.117.571-.321.347-.374.571-.76.577-1.244-.48-.276-1.986-.371-2.41 0z" transform="matrix(.51317 0 0 .51317 12.136 208.595)"/><path style="display:inline;fill:#fff;fill-opacity:1;stroke-width:1.42482;stroke-dasharray:none" d="M124.444 15.637a1.365 1.365 0 0 0-.334.06v-.002a.925.925 0 0 0-.575.52c-.11.463.338.601.665.541.226-.05.478-.14.668-.317.135-.125.261-.313.226-.475-.037-.138-.162-.24-.33-.288a1.033 1.033 0 0 0-.32-.04zm-18.298.28a1.339 1.339 0 0 0-.355.059.924.924 0 0 0-.575.519c-.11.463.339.601.666.541.226-.05.478-.14.668-.316.135-.125.26-.314.225-.476-.036-.138-.16-.24-.329-.288-.102-.029-.2-.041-.3-.04z" transform="matrix(.51317 0 0 .51317 12.136 208.595)"/></g></g></g></svg>
                            </label>
                            
                            <label> 
                            <input type="button" alt="Adicionar Hiperligação" name="media_options" class="media_options" value="lnk" />
                                <svg id="lnk" width="42.205" height="42.205" viewBox="0 0 11.167 11.167" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><g style="display:inline"><g transform="matrix(.25389 0 0 .25389 -18.126 -7.788)" style="display:inline;stroke-width:1.57999;stroke-dasharray:none"><circle style="display:inline;fill:none;fill-opacity:1;stroke:#0092ca;stroke-width:1.57999;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:none;stroke-opacity:1;paint-order:markers fill stroke" cx="93.384" cy="52.667" r="21.202"/><path style="fill:#0092ca;fill-opacity:1;stroke-width:1.57999;stroke-dasharray:none" d="M85.77 59.364c-2.657-.392-4.742-2.22-5.486-4.811-.255-.89-.256-2.338 0-3.271.54-1.978 2.061-3.603 4.123-4.405 1.107-.43 1.411-.464 4.2-.464 2.467 0 2.581.007 2.803.17.587.429.757 1.012.46 1.582-.32.614-.379.626-3.319.68-2.323.041-2.648.064-3.076.213-2.466.861-3.584 3.39-2.482 5.618.526 1.062 1.77 2.011 2.909 2.22.248.045 1.504.082 2.79.082 2.178 0 2.361.012 2.67.166.433.217.704.715.64 1.177-.049.362-.238.654-.591.913-.22.162-.348.17-2.719.182-1.368.007-2.683-.017-2.922-.052zm9.78-.007c-.467-.192-.839-.7-.839-1.145 0-.408.297-.882.669-1.068.308-.154.49-.166 2.67-.166 1.285 0 2.541-.037 2.79-.082.731-.134 1.479-.543 2.092-1.144 2.217-2.175 1.354-5.64-1.666-6.694-.428-.149-.753-.172-3.076-.213-2.927-.053-3.001-.068-3.31-.662-.309-.594-.15-1.166.445-1.598.229-.165.33-.172 2.808-.172 1.859 0 2.71.031 3.074.112 3.355.743 5.65 3.564 5.458 6.712-.171 2.808-2.028 5.109-4.788 5.93-.743.22-.792.224-3.436.25-1.735.016-2.756-.005-2.891-.06zm-6.788-5.318c-.433-.214-.672-.615-.672-1.13 0-.516.239-.917.672-1.13.267-.132.666-.145 4.608-.145 4.812 0 4.695-.013 5.09.567.411.604.172 1.516-.482 1.838-.266.131-.665.144-4.608.144-3.942 0-4.341-.013-4.608-.144z"/></g></g></svg>
                            </label>

                            <label> 
                            <input type="button" alt="Adicionar Código" name="media_options" class="media_options" value="txt" />
                                <svg id="txt" width="42.205" height="42.205" viewBox="0 0 11.167 11.167" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><g style="display:inline" transform="translate(-35.473 9.735)"><circle style="display:inline;fill:none;fill-opacity:1;stroke:#0092ca;stroke-width:.401136;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:none;stroke-opacity:1;paint-order:markers fill stroke" cx="41.056" cy="-4.152" r="5.383"/><path style="display:inline;fill:#0092ca;fill-opacity:1;stroke:#0092ca;stroke-width:.0448997;stroke-opacity:1" d="M39.084-5.724v.001a.09.09 0 0 0-.05.017l-.715.483-.761.527c-.064.046-.259.185-.397.29-.063.055-.143.127-.185.236.024.065.062.19.185.274.138.104.333.243.397.289l.76.527.716.484a.091.091 0 0 0 .077.012.095.095 0 0 0 .05-.038l.176-.27c.032-.044.02-.099-.024-.133l-.7-.505-.842-.592a.542.542 0 0 1-.049-.03.509.509 0 0 1 .05-.03l.842-.593.699-.505c.044-.034.056-.088.024-.132l-.175-.27a.097.097 0 0 0-.052-.037c-.002-.001-.005-.003-.008-.003-.006-.002-.012-.002-.018-.002zm3.944 0c-.006 0-.012 0-.017.002L43-5.72h.001a.096.096 0 0 0-.051.038l-.176.27c-.032.044-.02.098.024.132l.7.506.842.592a.54.54 0 0 1 .049.03.506.506 0 0 1-.05.03l-.842.592-.699.506c-.044.033-.055.088-.024.132l.176.27c.013.02.032.032.051.037l.009.003c.022.004.046 0 .067-.015l.715-.483.762-.527c.063-.046.258-.185.396-.29.123-.083.161-.209.185-.273-.041-.11-.122-.181-.185-.237-.138-.104-.333-.243-.396-.289l-.762-.527-.715-.483a.094.094 0 0 0-.05-.016z"/><path style="display:inline;fill:#0092ca;fill-opacity:1;stroke:none;stroke-width:.0434324;stroke-opacity:1" d="M41.517-6.629c-.027 0-.046.003-.053.012-.017.02-.077.205-.132.412a236.32 236.32 0 0 1-1.16 4.16c-.066.206-.113.38-.104.387.009.007.12.037.25.067.128.03.256.052.284.05.057-.004.105-.138.254-.713.121-.464.872-3.135 1.047-3.721.066-.222.12-.432.12-.467 0-.061-.363-.184-.506-.187z"/></g></svg>
                            </label> -->

                            <input class="btn right" type="submit" name="Publicar" id="submit" value="Publicar" />
                        </div>
                        </form>
                    <span>
                </div>


             <!-- Últimos 10 posts) -->
            <?php
                $index = 1; //Para ligar cada label à sua respectiva checkbox (dropdown-menu1, dropdown-menu2, dropdown-menu3...)
                if(!empty($userPosts->posts)){
                    foreach ($userPosts->posts as $row) {

                        $userPosts->count_post_faves($row['post_id']);
                        $userPosts->count_post_comments($row['post_id']);
                        $userPosts->count_post_shares($row['post_id']);

                        echo "<div class='post-box' id='".$row['post_id']."'>";
                        echo "<span class='user-frame'>";
                        echo    "<a href='#'><img class='avatar' src='../users/" . "{$userProfile->userData['handle']}" . "/" . "{$userProfile->userData['avatar']}" . "' /></a>";
                        echo "</span>";
                        echo "<span class='post-frame'>";
                        echo    "<span class='right'>";
                        echo        "<input class='target' id='dropdown-menu". $index ."' type='checkbox'>";
                        echo        "<label onclick='dropdown()' class='btn-dropdown-menu right' for='dropdown-menu". $index ."'><svg width='4.856' height='20.892' viewBox='0 0 1.285 5.528' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path style='fill:#808a99;fill-opacity:1;stroke-width:.0672245;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke markers fill' d='M1.285.642a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 .642.642.642 0 0 1 .642 0a.642.642 0 0 1 .643.642zM1.285 2.764a.642.642 0 0 1-.643.642A.642.642 0 0 1 0 2.764a.642.642 0 0 1 .642-.643.642.642 0 0 1 .643.643zM1.285 4.885a.642.642 0 0 1-.643.643A.642.642 0 0 1 0 4.885a.642.642 0 0 1 .642-.642.642.642 0 0 1 .643.642z'/></svg></label>";
                        echo        "<span class='options dropdown-menu'>";
                        echo            "<input class='li' type='button' data-id='" . $row['post_id'] . "' value='Editar'>";
                        echo            "<input class='li' type='button' data-id='" . $row['post_id'] . "' value='Afixar'>";
                        echo            "<input class='li' onclick='copyURL()' type='button' data-id='" . $row['post_id'] . "' value='Copiar'>";
                        echo            "<input class='li' onclick='deletePost()' type='button' data-id='" . $row['post_id'] . "' value='Eliminar'>";
                        echo        "</span>";
                        echo    "</span>";
                        echo    "<h3>{$userProfile->userData['name']}</h3>";
                        //echo    "<h4 class='timestamp'>@" . $handle . " &bull; " . time_elapsed_string($row['date']) . "</h4>";
                        echo    "<p>" . $row['text'] . "</p>";

                        //Verifica se o post tem conteúdo na tabela "média".
                       if(!empty($row['type'])){  
                            
                            //VIDEO - Se o conteúdo for um vídeo
                            if ($row['type'] == 'vid'){

                                //Converte o link do youtube com a função convertYoutube(url) para uma versão "embed"
                                $video = $userPosts->convertYoutube($row['content']);

                                //Imprime o video com <iframe>
                                echo "<div class='player'><iframe class='youtube' src='" . $video ."' frameborder='0' allowfullscreen></iframe></div>";

                            //PICTURE - Se o conteúdo for imagens
                            } else if($row['type'] == 'pic'){ 

                                //Recebe o array de imagens deste post
                                $userPosts->get_post_images($row['post_id']);

                                //Conta quantas imagens estão no array
                                $numImages = count($userPosts->pictures);

                                //Se for uma imagem
                                if ($numImages == 1) {
                                    foreach ($userPosts->pictures as $image) {
                                        echo "<div class='picturebox pics1'>";
                                        echo "<img class='first' src='../users/". "{$userProfile->userData['handle']}" . "/media/" . $image['content'] . "'>";
                                        echo "</div>";
                                    }
                                //Se for duas imagens
                                } else if($numImages == 2){
                                    $picture = array("", "");
                                    $i = 0;
                                    while($i < 2){
                                        foreach ($userPosts->pictures as $image) {
                                            $picture[$i] = $image['content'];
                                            $i++;
                                        }
                                    }
                                    echo "<div class='picturebox pics2'>";
                                    echo "<span>";
                                    echo "    <img class='first' src='../users/{$userProfile->userData['handle']}/media/" . $picture[0] . "'>";
                                    echo "</span>";
                                    echo "<span>";
                                    echo "    <img class='second' src='../users/{$userProfile->userData['handle']}/media/" . $picture[1] . "'>";
                                    echo " </span>";
                                    echo "</div>";
                                //Se for três imagens
                                } else if($numImages == 3){
                                    $picture = array("", "", "");
                                    $i = 0;
                                    while($i < 3){
                                        foreach ($userPosts->pictures as $image) {
                                            $picture[$i] = $image['content'];
                                            $i++;
                                        }
                                    }
                                    echo "<div class='picturebox pics3'>";
                                    echo "<span>";
                                    echo "    <img class='first' src='../users/{$userProfile->userData['handle']}/media/" . $picture[0] . "'>";
                                    echo "</span>";
                                    echo "<span>";
                                    echo "    <img class='second' src='../users/{$userProfile->userData['handle']}//media/" . $picture[1] . "'>";
                                    echo "    <img class='third' src='../users/{$userProfile->userData['handle']}/media/" . $picture[2] . "'>";
                                    echo " </span>";
                                    echo "</div>";
                                //Se for quatro imagens
                                } else if($numImages == 4){
                                    $picture = array("", "", "", "");
                                    $i = 0;
                                    while($i < 4){
                                        foreach ($userPosts->pictures as $image) {
                                            $picture[$i] = $image['content'];
                                            $i++;
                                        }
                                    }
                                    echo "<div class='picturebox pics4'>";
                                    echo "<span>";
                                    echo "    <img class='first' src='../users/{$userProfile->userData['handle']}/media/" . $picture[0] . "'>";
                                    echo "    <img class='second' src='../users/{$userProfile->userData['handle']}/media/" . $picture[1] . "'>";
                                    echo "</span>";
                                    echo "<span>";
                                    echo "    <img class='third' src='../users/{$userProfile->userData['handle']}/media/" . $picture[2] . "'>";
                                    echo "    <img class='fourth' src='../users/{$userProfile->userData['handle']}/media/" . $picture[3] . "'>";
                                    echo "</span>";
                                    echo "</div>";
                                }

                            //CODE - Se o conteúdo for código
                            } else if($row['type'] == 'txt'){ 
                                $userCode = $row['content'];
                                echo "<pre><code>". htmlentities($userCode) ."</code></pre>";

                            //LINK - Se o conteúdo for um link
                            } else if($row['type'] == 'lnk'){ 
                                echo "<div class='linkbox'><a href='>" . $row['content'] . "' target='_blank'>" . $row['content'] . "</a></div>";
                                //Ver exemplo: https://stackoverflow.com/questions/31234355/get-page-title-and-inner-image-with-javascript
                            }
                        } 
                        /* echo $row['type']; */
                        echo    "<div class='post-interaction'>";
                        echo        "<span class='reply-icon'><svg id='reply-icon' width='19.219' height='17.366' viewBox='0 0 5.085 4.595' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path d='M4.134 4.827a1.447 1.447 0 0 1-.685-.321l-.126-.11-.577-.01a2.711 2.711 0 0 1-1.718-.527C.64 3.563.36 3.174.248 2.748-.034 1.658.813.564 2.149.294 2.506.22 3.18.238 3.519.328c.369.098.849.358 1.109.6.45.42.651.851.651 1.394 0 .534-.2.969-.633 1.38-.157.147-.211.222-.195.266.031.086.214.355.355.521.13.156.149.25.055.3-.097.05-.504.072-.727.038z' transform='translate(-.194 -.249)'/></svg> " . $userPosts->replies['postreplies'] ."</span>";
                        echo        "<span class='fave-icon'><svg id='fave-icon' width='20.495' height='19.946' viewBox='0 0 5.423 5.277' xml:space='preserve' xmlns='http://www.w3.org/2000/svg'><path d='M1.258 5.376c-.046-.046-.083-.12-.083-.163 0-.044.06-.393.136-.777.074-.383.136-.748.136-.81 0-.099-.044-.154-.366-.459-.929-.878-.945-.9-.799-1.08.056-.069.14-.086.877-.177.62-.076.83-.114.874-.158.031-.03.197-.37.369-.755.171-.384.343-.725.38-.758a.23.23 0 0 1 .323.017c.037.042.212.397.389.788.214.476.343.722.389.742.037.017.415.073.84.125.857.104.914.125.914.334 0 .133-.002.135-.69.779-.275.258-.51.497-.52.53-.011.034.05.422.136.862.126.65.148.815.117.884-.036.078-.158.16-.24.16-.02 0-.346-.177-.724-.392-.41-.234-.724-.392-.78-.392-.054 0-.37.158-.78.392-.378.215-.716.391-.75.391-.036 0-.102-.037-.148-.083z' transform='translate(-.214 -.182)'/></svg> " . $userPosts->favourites['postfaves'] ."</span>";
                        echo        "<span class='share-icon'><svg id='share-icon' width='26' height='18' viewBox='0 0 26 18' xmlns='http://www.w3.org/2000/svg'><path d='M13.62 3.76103L11.546 1.24674C11.277 0.920628 11.5081 0.428571 11.9308 0.428571H21.4704C22.0502 0.428571 22.2555 0.885714 22.2857 1.11429V10.3857C22.2857 10.6619 22.5096 10.8857 22.7857 10.8857H24.9475C25.3689 10.8857 25.6013 11.375 25.3351 11.7016L20.5927 17.5207C20.3917 17.7674 20.0143 17.7659 19.8151 17.5177L15.1469 11.6986C14.8843 11.3713 15.1173 10.8857 15.5369 10.8857H17.4373C17.7134 10.8857 17.9373 10.6619 17.9373 10.3857V4.44286C17.9373 4.16672 17.7134 3.94286 17.4373 3.94286H14.0058C13.8565 3.94286 13.715 3.87617 13.62 3.76103Z'/><path d='M11.1312 6.13148L6.61859 0.461985C6.42613 0.220182 6.06258 0.209138 5.8558 0.438814L0.751372 6.10831C0.461699 6.43005 0.69003 6.94286 1.12296 6.94286H3.66194C3.94015 6.94286 4.16485 7.16859 4.16213 7.44679C4.13271 10.4467 4.09881 15.8077 4.16725 16.7143C4.23507 17.6127 4.88997 17.6803 5.27074 17.5917C5.32043 17.5801 5.37091 17.5714 5.42193 17.5714H14.1953C14.6117 17.5714 14.8457 17.0922 14.5896 16.7639L12.5613 14.1639C12.4665 14.0424 12.3211 13.9714 12.1671 13.9714H8.74391C8.46777 13.9714 8.24391 13.7476 8.24391 13.4714V7.44286C8.24391 7.16672 8.46777 6.94286 8.74391 6.94286H10.74C11.1587 6.94286 11.3919 6.45906 11.1312 6.13148Z'/></svg>" . $userPosts->shares['postshares'] ."</span>";
                        echo    "</div>";
                        /* echo    "<p>Post #" . $row['post_id'] . "</p>"; */
                        echo "</span>";
                        echo "</div>";
                        $index+=1;
                    };
                    // Nesta instância, $i tem valor 11;
                } else {
                    echo "<div class='post-box'>";
                    echo "Isto aqui está mais vazio do que o pólo norte! D:";
                    echo "</div>";
                };
            ?>
            </span>
        </div>
    </div>
</main>