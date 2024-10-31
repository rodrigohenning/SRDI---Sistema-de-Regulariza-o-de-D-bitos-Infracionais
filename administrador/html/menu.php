<div class="offcanvas offcanvas-start sidebar-nav " id="sidebarMenu">
    <div class="offcanvas-body p-1">
        <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        Menu
                    </div>
                </li>
                <li>
                    <a href="index.php" class="nav-link px-3" onclick="highlightMenuItem(this)">
                        <span class="me-2"><i class="bi-speedometer2"></i></span>
                        <span>Dashboard</span>
                    </a>

                    <a href="autuados.php" class="nav-link px-3" onclick="highlightMenuItem(this)">
                        <span class="me-2"><i class="bi bi-people"></i></span>
                        <span>Autuados</span>
                    </a>
                    <a href="autuacoes.php" class="nav-link px-3" onclick="highlightMenuItem(this)">
                        <span class="me-2"><i class="bi bi-pen"></i></span>
                        <span>Autuações</span>
                    </a>
                    <a href="emitirBoletos.php" class="nav-link px-3" onclick="highlightMenuItem(this)">
                        <span class="me-2"><i class="bi bi-upc"></i></span>
                        <span>Emitir Boleto</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-binoculars"></i></span>
                        <span>Monitoramento</span>
                    </a>
                </li>
                <li class="my-4">
                    <hr class="dropdown-divider bg-light" />
                </li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                        Addons
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-graph-up"></i></span>
                        <span>Charts</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-table"></i></span>
                        <span>Tables</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
    // Função para destacar o item de menu correspondente à página atual
    document.addEventListener("DOMContentLoaded", function() {
        var currentPageLink = document.querySelector('#sidebarMenu a[href="' + currentPage + '"]');
        if (currentPageLink) {
            currentPageLink.classList.add('active');
        }
    });
</script>