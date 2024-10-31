<div class="container-fluid">
    <a class="navbar-brand me-auto ms-lg-0 ms-5 text-uppercase fw-bold" href="index.php"><img class="profile-img"
            src="../img/logo_vertical_branco.png" width="95" height=""></a>
    <div class="collapse navbar-collapse" id="topNavBar">
        <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-fill"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="../index.php">Sair</a></li>
                    <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->
                </ul>
            </li>
        </ul>
    </div>
</div>

<style>
    .profile-img {
        margin-left: 80px;
        /* Adicione o valor desejado de espaço à esquerda */
    }

    #sidebarMenu {
        position: fixed;
        /* Alterado de "fixed" para "relative" */
        top: 80px;
        background-color: #fff;

    }

    .row {
        margin-top: 20px;

    }

    #sidebarMenu .nav-link {
        padding: .5rem 1rem;
        display: block;
        color: #000;
    }

    #sidebarMenu .active {
        background-color: #8ac5ff;

    }
</style>