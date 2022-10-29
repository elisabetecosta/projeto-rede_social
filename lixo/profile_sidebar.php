<section id="posts" class="posts-container">
    <div class="sidebox">
        <h3><?php echo $title; ?></h3>
        <!-- Descrição de perfil escrita pelo utilizador -->
        <p><?php echo $description; ?></p>

        <h3><?php echo $gallerytitle ?></h3> 
        <!-- Mostra as 4 fotografias mais recentes do utilizador com sessão iniciada -->
        <?php foreach ($displayMedia as $row) { print "<img width='130px' src='../users/". $userData['handle'] ."/media/" .$row["content"]. "'>"; } //print_r($displayMedia); ?>
    </div>

    <div class="two">      
        <div class="newpost"><?php include 'newpost.php'; ?></div>
    </div>

</section>