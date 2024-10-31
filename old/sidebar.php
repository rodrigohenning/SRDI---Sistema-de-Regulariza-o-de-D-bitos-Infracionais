    <!-- Sidebar -->
    <nav class="sidebar" id="sidebarMenu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="index.php" onclick="highlightMenuItem(this)">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="autuados.php" onclick="highlightMenuItem(this)">
                    <i class="fas fa-user me-2"></i>Autuados
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="autuacoe.php" onclick="highlightMenuItem(this)">
                    <i class="fas fa-gavel me-2"></i>Autuações
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="boletos.php" onclick="highlightMenuItem(this)">
                    <i class="fas fa-file-alt me-2"></i>Boletos
                </a>
            </li>
        </ul>
    </nav>

    <script>
    // Função para destacar o item de menu correspondente à página atual
    document.addEventListener("DOMContentLoaded", function() {
        var currentPageLink = document.querySelector('#sidebarMenu a[href="' + currentPage + '"]');
        if (currentPageLink) {
            currentPageLink.classList.add('active');
        }
    });
</script>