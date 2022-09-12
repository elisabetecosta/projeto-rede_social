<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Iniciar sessão</title>
        <link href="styles/main.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <?php
            include 'includes/connect_db.php';

            // Verifica se existe a sessão
            if (session_status() !== PHP_SESSION_ACTIVE) 
            {

                // Cria a instrução sql para adicionar
                $sql = "SELECT * FROM users WHERE
                user_email = '$_POST[email]'";

                $result = mysqli_query($connection, $sql) or die (mysqli_error($connection));
                $lign = mysqli_fetch_assoc($result);

                if (strcmp($_POST['password'], $lign['password'])==0)
                {
                    echo "<h2>Login efetuado com sucesso!</h2>";

                    session_start();
                    $_SESSION['user_id']=$lign['user_id'];
                    $_SESSION['user_email']=$lign['user_email'];
                    header('Location: login2.php');

                    ?>

                    <input type="button" value="Colocar Post" onclick="window.open('inserirP.php', '_self')">
                    <input type="button" value="Listar Posts" onclick="window.open('listarP.php', '_self')">
                    <input type="button" value="Meus Posts" onclick="window.open('meusP.php', '_self')">

                    <?php
                }
                    else
                    {
                        echo "<h2>Dados de login inválidos!</h2>";
                    } // else da verificação da variável de sessão
                    
            } // fecha o if da variável sessão

            else
            {
                echo "<h2>Bem-vindo " .$lign['name'] ."!</h2>";
                ?>

                <!--REDIRECIONA PARA A PAGINA DE PERFIL-->

                <?php
                //fim do else da verificação da sessão
            }

            mysqli_close($connection);
            ?>

            <input type="button" value="Voltar a tentar" onclick="window.open('index.html', '_self')">
            <input type="button" value="Criar conta" onclick="window.open('register.html', '_self')">
            
    </body>
</html>