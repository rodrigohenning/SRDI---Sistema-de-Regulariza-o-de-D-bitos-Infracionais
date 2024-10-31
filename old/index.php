<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Cabeçalho  -->
    <?php include 'header.php';?>
</head>

<body>
    
    <!-- Barra lateral (MENU)  -->
    <?php include 'sidebar.php';?>


<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <h1 class="mt-4"><b>Dashboard</b></h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Status:</h5>
                        <p class="card-text">Descrição ou informações sobre o insight 1.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Insight 2</h5>
                        <p class="card-text">Descrição ou informações sobre o insight 2.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Insight 3</h5>
                        <p class="card-text">Descrição ou informações sobre o insight 3.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
            <div class="card bg-warning text-dark h-100">
              <div class="card-body py-5">Warning Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">Success Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5">Danger Card</div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

    <!-- /#page-content-wrapper -->

    <!-- Footer -->
    <?php include 'footer.php';?>

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

</html>
