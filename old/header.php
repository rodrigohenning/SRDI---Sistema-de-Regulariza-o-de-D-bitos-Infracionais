<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema DRDI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <!-- CSS do DataTables -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    


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
            position: fixed; /* Alterado de "fixed" para "relative" */
            top: 80px;
            left: 0;
            height: 500px;
            width: 240px;
            /* max-height: 1000vh; Definir altura máxima */
            overflow-y: auto; /* Adicionar rolagem vertical */
            z-index: 1;
            background-color: #fff;
            border-right: 1px solid #dee2e6;
        }

        #sidebarMenu .nav-link {
            padding: .5rem 1rem;
            display: block;
            color: #000;
        }

        #sidebarMenu .active{
            background-color: #8ac5ff;

        }
        
        #sidebarMenu .nav-link:hover {
            background-color: #f1f1f1;
        }
        
        #page-content-wrapper {
            position: relative;
            margin-left: 240px;
            top: 0px;
            transition: margin-left 0.3s;
        }




    </style>
</head>

<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">        
                <img class="profile-img" src="../img/logo_vertical_branco.png" width="95" height="">
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
                            <li><a class="dropdown-item" href="../index.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
    var currentPage = "<?php echo basename($_SERVER['PHP_SELF']); ?>";
</script>
