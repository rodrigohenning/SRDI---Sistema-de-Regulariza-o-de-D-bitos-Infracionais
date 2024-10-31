<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema DRDI</title>
    <?php
/*
 *  ╔═════════════════════════════════════════════════════════════════════════╗
 *  ║            Sistema de Regularização de Débitos Infracionais - SRDI      ║
 *  ║                                                                         ║
 *  ║   Desenvolvido por: Rodrigo Henning             ║
 *  ║   Data de criação: 07/08/2024                                           ║
 *  ║   Descrição: Código PHP para o gerenciamento e regularização de         ║
 *  ║   débitos infracionais, permitindo a organização e o acompanhamento     ║
 *  ║   de pendências financeiras no sistema.                                 ║
 *  ║                                                                         ║
 *  ║   © Rodrigo - Todos os direitos reservados                              ║
 *  ╚═════════════════════════════════════════════════════════════════════════╝
 */
 
?>
<link href="include/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/background.jpeg'); /* Adicione o caminho para a sua imagem de fundo */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* opacity: 0.9;Ajusta a opacidade apenas do plano de fundo */
        }
        .card {
            width: 400px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            border-radius: 15px 15px 0 0;
            color: #fff;
        }
        .card-body {
            padding: 30px;
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .form-floating input {
            border-radius: 10px;
        }
        .btn-login {
            border-radius: 10px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .text-center{
            text-align: center !important;
            font-size: larger; 
        }
        .notification {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

         /* Aplica a opacidade apenas na imagem de fundo */
         body::after {
            content: "";
            background: url('img/background.jpeg');
            background-size: cover;
            opacity: 0.8;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            z-index: -1;
        }       
        
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center">Login</h5>
            </div>

            <div class="card-body">
                <div class="logo">
                    <img src="img/logo_vertical_verde.png" alt="Logo" width="150">
                    <br><br><h1 class="text-center">Sistema de Regularização de Débitos Infracionais - SRDI</h1>
                </div>
                    <!-- Notificação -->
                        <?php if(isset($_SESSION['senha_invalida'])): ?>
                        <div class="notification">
                            <center><p>Usuário e/ou senha inválidos</p></center>
                        </div>
                        <?php unset($_SESSION['senha_invalida']); ?>
            <?php endif; ?>
                <form action="logar.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuário.example" required>
                        <label for="usuario">Usuário</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Password" required>
                        <label for="senha">Password</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-login">Login</button>
                        <br><center><p class="text-muted">&copy; 2024 - DTIC/IMAC</p></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
