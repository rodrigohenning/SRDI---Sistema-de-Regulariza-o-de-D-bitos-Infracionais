<?php
session_start();
?>

<!DOCTYPE html>
<html> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logar no Sistema</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="include/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="include/css/login.css">
</head>
<body>
    <section class="section">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <?php if(isset($_SESSION['nao_autenticado'])): ?>  
                        <div class="notification is-danger">
                            <p>ERRO: Usuário ou senha inválidos.</p>
                        </div>
                        <?php unset($_SESSION['nao_autenticado']); ?>
                    <?php endif; ?>

                    <div class="box">
                        <h2 class="logo">
                            <img src="imagens/LogoImac.png" class="rounded" alt="Brasao IMAC" width="300" height="150">
                        </h2>
                        <h2 class="logo">
                            <img src="imagens/LogoGoverno.jpg" class="rounded" alt="Brasao Governo" width="130" height="170">
                        </h2><br>
                        <h3 class="title has-text-grey">DRDI</h3>   

                        <form action="logar.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="usuario" class="input is-large" placeholder="Usuário" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large" type="password" placeholder="Senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Logar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
