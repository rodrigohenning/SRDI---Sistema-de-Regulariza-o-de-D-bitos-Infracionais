<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema DRDI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fc;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        #sidebarMenu {
            position: fixed;
            top: 80px;
            left: 0;
            height: 100%;
            width: 240px;
            z-index: 1;
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            padding-top: 1rem;
        }

        #sidebarMenu .nav-link {
            padding: .5rem 1rem;
            display: block;
            color: #000;
        }

        #sidebarMenu .nav-link:hover {
            background-color: #f1f1f1;
        }

        #page-content-wrapper {
            margin-left: 240px;
            transition: margin-left 0.3s;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1;
        }

        .panel {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img class="profile-img" src="../img/logo_vertical_branco.png" width="95" height=""> Sistema DRDI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user"></i> Usuário
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <!-- <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a></li> -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <nav id="sidebarMenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php" onclick="highlightMenuItem(this)">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="highlightMenuItem(this)">
                    <i class="fas fa-user me-2"></i>Autuados
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="highlightMenuItem(this)">
                    <i class="fas fa-gavel me-2"></i>Autuações
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="highlightMenuItem(this)">
                    <i class="fas fa-file-alt me-2"></i>Boletos
                </a>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h1 class="mt-4"><b>Dashboard</b></h1>
            <div class="panel">
                <p>Aqui está o conteúdo do Dashboard.</p>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Função para adicionar classe de destaque ao item de menu selecionado
        function highlightMenuItem(item) {
            // Remove a classe 'active' de todos os itens de menu
            document.querySelectorAll('#sidebarMenu .nav-link').forEach((element) => {
                element.classList.remove('active');
            });
            // Adiciona a classe 'active' apenas ao item de menu clicado
            item.classList.add('active');
        }
    </script>
</body>
<footer class="footer">
    <div class="container-fluid text-center">
        © 2024 Sistema DRDI. Todos os direitos reservados.
    </div>
</footer>

</html>
