<!DOCTYPE html>
<html lang="pt-br">
<?php
// Obtém o ID do usuário da sessão
session_start(); // Inicia a sessão
if(isset($_SESSION['id_usuario'])) {
    $idUsuario = $_SESSION['id_usuario'];
} else {
    // Se o ID do usuário não estiver definido na sessão, redirecione para a página anterior ou faça outro tratamento adequado
    header("Location: pagina_anterior.php");
    exit();
}
?>
<head>
  <?php include 'html/head.php'; ?>
  <script src="js/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <?php include 'html/nav.php'; ?>
  </nav>

  <?php include 'html/menu.php'; ?>

  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4>Autuações</h4>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Autuações
            </div>
            <div class="card-body">
            <div class="container mt-5">
        <h2>Emissor de Boleto</h2>
        <form action="processar_emissao.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_POST['id']); ?>">
            <input type="hidden" name="sei" value="<?php echo htmlspecialchars($_POST['sei']); ?>">
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-control" value="<?php echo htmlspecialchars($_POST['cpf']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor R$</label>
                <input type="text" id="valor" name="valor" class="form-control" value="<?php echo htmlspecialchars($_POST['valor']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="desconto" class="form-label">Desconto (%)</label>
                <input type="number" id="desconto" name="desconto" class="form-control" min="0" max="100" step="0.01">
            </div>
            <div class="mb-3">
                <label>Parcelar?</label>
                <div>
                    <input type="radio" id="parcelar-sim" name="parcelar" value="sim">
                    <label for="parcelar-sim">Sim</label>
                    <input type="radio" id="parcelar-nao" name="parcelar" value="nao" checked>
                    <label for="parcelar-nao">Não</label>
                </div>
            </div>
            <div id="parcelas-section" style="display: none;">
                <div class="mb-3">
                    <label for="quantidade-parcelas" class="form-label">Quantidade de Parcelas</label>
                    <input type="number" id="quantidade-parcelas" name="quantidade_parcelas" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="valor-entrada" class="form-label">Valor de Entrada R$</label>
                    <input type="number" id="valor-entrada" name="valor_entrada" class="form-control">
                </div>
                <div class="mb-3">
                    <span id="valor-parcela" class="form-text"></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Emitir Boleto</button>
        </form>
    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include 'html/footer.php'; ?>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>

  <script>
        $(document).ready(function() {
            // Mostrar ou esconder a seção de parcelas
            $('input[name="parcelar"]').on('change', function() {
                if ($('#parcelar-sim').is(':checked')) {
                    $('#parcelas-section').show();
                } else {
                    $('#parcelas-section').hide();
                    $('#valor-parcela').text('');
                    $('#quantidade-parcelas').val('');
                    $('#valor-entrada').val('');
                }
            });

            // Calcular o valor das parcelas dinamicamente
            $('#quantidade-parcelas, #valor-entrada, #desconto').on('input', function() {
                calcularParcelas();
            });

            function calcularParcelas() {
                var totalValor = parseFloat($('#valor').val());
                var valorEntrada = parseFloat($('#valor-entrada').val());
                var quantidadeParcelas = parseInt($('#quantidade-parcelas').val());
                var desconto = parseFloat($('#desconto').val()) || 0;

                if (isNaN(totalValor) || isNaN(valorEntrada) || isNaN(quantidadeParcelas) || quantidadeParcelas <= 0) {
                    $('#valor-parcela').text('');
                    return;
                }

                // Aplica o desconto
                var valorComDesconto = totalValor * (1 - desconto / 100);
                var valorRestante = valorComDesconto - valorEntrada;
                var valorParcela = valorRestante / quantidadeParcelas;

                if (valorParcela > 0) {
                    $('#valor-parcela').text('Valor de cada parcela: R$ ' + valorParcela.toFixed(2));
                } else {
                    $('#valor-parcela').text('');
                }
            }
        });
    </script>

</body>
</html>
