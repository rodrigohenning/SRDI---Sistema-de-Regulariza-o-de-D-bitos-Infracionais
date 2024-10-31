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
                      <th>Telefone</th>
                      <th>Email</th>
                      <th>Endereço</th>
                      <th>Cidade</th>
                      <th>Status</th>
                      <th>Prazo Dias</th>
                      <th>Data Prazo</th>
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

  <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title" id="editarModalLabel">Detalhes da Autuação</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <p><strong>Nº SEI:</strong> <span id="modalNumSei"></span></p>
              <p><strong>CPF:</strong> <span id="modalCPF"></span></p>
              <p><strong>Nome:</strong> <span id="modalNome"></span></p>
              <p><strong>Último Status:</strong> <span id="modalStatus"></span></p>
              <p><strong>Prazo Dias:</strong> <span id="modalPrazoDias"></span></p>
              <p><strong>Data Prazo:</strong> <span id="modalDataPrazo"></span></p>
            </div>
          </div>
          <div class="my-4"></div>

<form id="formularioNovaMovimentacao">
    <div class="mb-3">
        <label for="selectStatus" class="form-label">Novo Status:</label>
        <select class="form-select" id="selectStatus" name="status">
            <!-- Opções do select devem ser preenchidas dinamicamente -->
            <!-- Exemplo: <option value="1">Status 1</option> -->
        </select>
    </div>
    <input type="hidden" name="id_autuacao" id="id_autuacao"> <!-- Certifique-se de definir o valor corretamente -->
    <div class="mb-3">
        <label for="descricaoMovimentacao" class="form-label">Descrição:</label>
        <input type="text" class="form-control" id="descricaoMovimentacao" name="descricao">
    </div>
    <button type="button" id="btnEnviarMovimentacao" class="btn btn-primary">Gravar Movimentação</button>

</form>

          <div class="mt-4">
            <h5>Histórico de Movimentações</h5>
            <table id="tabelaHistoricoMovimentacoes" class="table">
              <thead>
                <tr>
                  <th>Id Mov.</th>
                  <th>Data</th>
                  <th>Prazo</th>
                  <th>Status</th>
                  <th>Descrição</th>
                  <th>Autorizado</th>
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
      $('#tabela-dados tbody').on('click', 'tr', function() {
        var data = $('#tabela-dados').DataTable().row(this).data();
        exibirDetalhesAutuacao(data.id_autuacao, data.n_proc_sei, data.cpf, data.nome, data.status, data.dias_restantes, data.data_prazo);
      });
    });

    function carregarTabelaDados() {
      $.getJSON('controle/busca_autuacoes.php', function(dados) {
        $('#tabela-dados').DataTable({
          "processing": true,
          "data": dados,
          "columns": [{
              "data": "id_autuacao"
            },
            {
              "data": "n_proc_sei"
            },
            {
              "data": "valor_multa"
            },
            {
              "data": "data_atuacao"
            },
            {
              "data": "cpf"
            },
            {
              "data": "nome"
            },
            {
              "data": "telefone"
            },
            {
              "data": "email"
            },
            {
              "data": "endereco"
            },
            {
              "data": "cidade"
            },
            {
              "data": "status"
            },
            {
              "data": "dias_restantes",
              "render": function(data, type, row) {
                if (data <= 2) {
                  return '<button class="btn btn-danger">' + data + '</button>';
                } else if (data <= 10) {
                  return '<button class="btn btn-warning">' + data + '</button>';
                } else {
                  return '<button class="btn btn-success">' + data + '</button>';
                }
              }
            },
            {
              "data": "data_prazo"
            },
            {
              "data": null,
              "defaultContent": "<button class='btn btn-primary btn-editar bi bi-arrow-left-right'>Movimentar</button>"
            }
          ],
        });
      });
    }

    function exibirDetalhesAutuacao(id, numSei, cpf, nome, status, prazoDias, dataPrazo) {
      document.getElementById('id_autuacao').value = id;
      document.getElementById('modalNumSei').innerText = numSei;
      document.getElementById('modalCPF').innerText = cpf;
      document.getElementById('modalNome').innerText = nome;
      document.getElementById('modalStatus').innerText = status;
      document.getElementById('modalPrazoDias').innerText = prazoDias;
      document.getElementById('modalDataPrazo').innerText = dataPrazo;
      var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
      editarModal.show();
      preencherSelectStatus();
      carregarHistoricoMovimentacoes(id);
    }

    function preencherSelectStatus() {
      fetch('controle/banco_status.php')
        .then(response => response.json())
        .then(data => {
          var selectStatus = document.getElementById('selectStatus');
          selectStatus.innerHTML = '';
          selectStatus.innerHTML += '<option value="">Selecione o status</option>';
          data.forEach(status => {
            selectStatus.innerHTML += `<option value="${status.id_status}">${status.descricao}</option>`;
          });
        })
        .catch(error => {
          console.error('Erro ao obter os status:', error);
        });
    }

    function carregarHistoricoMovimentacoes(idProcesso) {
      fetch(`controle/historico_movimentacoes.php?id=${idProcesso}`)
        .then(response => response.json())
        .then(data => {
          var tbody = document.querySelector('#tabelaHistoricoMovimentacoes tbody');
          tbody.innerHTML = '';
          data.forEach(movimentacao => {
            var row = `<tr>
                               <td>${movimentacao.id_mov}</td>
                               <td>${movimentacao.data}</td>
                               <td>${movimentacao.data_prazo}</td>
                               <td>${movimentacao.status_descricao}</td>
                               <td>${movimentacao.descricao}</td>
                               <td>${movimentacao.nome_usuario}</td>
                           </tr>`;
            tbody.innerHTML += row;
          });
        })
        .catch(error => {
          console.error('Erro ao obter o histórico de movimentações:', error);
        });
    }

   


    function fecharModal() {
      var modalElement = document.getElementById('editarModal');
      var modal = bootstrap.Modal.getInstance(modalElement);
      modal.hide();
    }

    var botaoFecharModal = document.getElementById('botaoFecharModal');
    botaoFecharModal.addEventListener('click', fecharModal);


  </script>


<script>
document.getElementById('btnEnviarMovimentacao').addEventListener('click', function(event) {
    event.preventDefault();

    console.log('Evento de clique no botão de envio acionado.');

    // Obtendo os dados do formulário
    var status = document.getElementById('selectStatus').value;
    var descricao = document.getElementById('descricaoMovimentacao').value;
    var idAutuacao = document.getElementById('id_autuacao').value;

    console.log('Dados obtidos do formulário:', { status, descricao, idAutuacao });

    // Criando um objeto FormData e adicionando os dados do formulário
    var formData = new FormData();
    formData.append('status', status);
    formData.append('descricao', descricao);
    formData.append('id_autuacao', idAutuacao);

    // Enviando a solicitação POST para a página de destino
    fetch('controle/cadastrar_mov.php', {
            method: 'POST',
            body: formData // Usando FormData em vez de JSON.stringify
        })
        .then(response => response.json())
        .then(data => {
            console.log('Resposta do servidor:', data);

            // Verificar se o envio foi bem-sucedido
            if (data.success) {
                // Fechar o modal
                var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
                editarModal.hide();
                // Exibir uma mensagem de sucesso
                Swal.fire({
                    title: "Movimentação atualizada com sucesso!",
                    text: "",
                    icon: "success"
                }).then(() => {
                    // Recarregar a página após fechar o modal
                    window.location.reload();
                });
            } else {
                // Exibir uma mensagem de erro
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao enviar dados:', error);
            // Exiba uma mensagem de erro para o usuário
            alert('Ocorreu um erro ao enviar os dados.');
        });
});


</script>

</body>

</html>
