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
              <div class="col-md-12 text-center mt-1">
              </div>
              <div class="table-responsive">
                <table id="tabela-dados" class="table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nº SEI</th>
                      <th>Valor R$</th>
                      <th>Data Autuação</th>
                      <th>CPF</th>
                      <th>Nome</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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
      carregarTabelaDados();

      $('#tabela-dados tbody').on('click', 'button.btn-editar', function() {
        var table = $('#tabela-dados').DataTable();
        var data = table.row($(this).parents('tr')).data();
        
        emitirBoleto(data.id_autuacao, data.n_proc_sei, data.valor_multa, data.cpf);
      });
    });

    function carregarTabelaDados() {
      $.getJSON('controle/aguardando_emissao.php', function(dados) {
        $('#tabela-dados').DataTable({
          "processing": true,
          "data": dados,
          "columns": [
            { "data": "id_autuacao" },
            { "data": "n_proc_sei" },
            { "data": "valor_multa" },
            { "data": "data_atuacao" },
            { "data": "cpf" },
            { "data": "nome" },
            {
              "data": null,
              "defaultContent": "<button class='btn btn-primary btn-editar bi bi-upc'>Emitir Boleto</button>"
            }
          ],
        });
      });
    }

    function emitirBoleto(id, sei, valor, cpf) {
      // Cria um formulário temporário para enviar os dados
      var form = $('<form>', {
        'method': 'POST',
        'action': 'emitirBoletos_emissao.php'
      });

      // Adiciona os campos necessários ao formulário
      form.append($('<input>', {
        'type': 'hidden',
        'name': 'id',
        'value': id
      }));
      form.append($('<input>', {
        'type': 'hidden',
        'name': 'sei',
        'value': sei
      }));
      form.append($('<input>', {
        'type': 'hidden',
        'name': 'valor',
        'value': valor
      }));
      form.append($('<input>', {
        'type': 'hidden',
        'name': 'cpf',
        'value': cpf
      }));

      // Adiciona o formulário ao corpo e o envia
      form.appendTo('body').submit();
    }
  </script>
</body>
</html>
