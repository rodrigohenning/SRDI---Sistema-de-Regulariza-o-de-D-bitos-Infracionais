<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- header  -->
  <?php include 'html/head.php'; ?>
  <script src="js/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert2.min.css">

</head>

<body>
  <!-- barra de navegação superior-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <?php include 'html/nav.php'; ?>
  </nav>
  <!-- barra de navegação superior -->

  <!-- Menu -->
  <?php include 'html/menu.php'; ?>
  <!-- Menu -->

  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4>Dashboard</h4>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Dados Autuados
            </div>
            <div class="card-body">

              <div class="col-md-12 text-center mt-1">
                <!-- Botão de cadastro com estilo Bootstrap -->
                <a href="cadastro_autuado.php" class="btn btn-info btn-lg bi bi-person-plus"><span
                    style="font-size: 1.2em;"></span>
                  Adicionar</a>
              </div>

              <div class="table-responsive">
                <table id="tabela-dados" class="table" style="width: 100%">
                  <thead>
                    <tr>
                      
                      <th>ID</th>
                      <th>CPF</th>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>Email</th>
                      <th>Endereço</th>
                      <th>Cidade</th>
                      <th>Editar</th><!-- Coluna de seleção -->
                      <th><center>Resgistrar</center></th><!-- Coluna de seleção -->
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>

              </div>
              <!-- <div id="dados-selecionados"></div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  
  <!-- Modal  Atualizar -->
  <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Editar Informações</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
          <!-- Formulário -->
          <!-- Formulário -->
          <form id="formularioModal">
            <div class="form-group">
              <label for="idInput">Código ID</label>
              <input type="text" class="form-control" id="idInput" readonly>
            </div>
            <div class="form-group">
              <label for="cpfInput">CPF:</label>
              <input type="text" class="form-control" id="cpfInput" readonly>
            </div>
            <div class="form-group">
              <label for="nomeInput">Nome:</label>
              <input type="text" class="form-control" id="nomeInput" readonly>
            </div>
            <div class="form-group">
              <label for="telefoneInput">Telefone:</label>
              <input type="text" class="form-control" id="telefoneInput" placeholder="(xx)xxxxx-xxxx">
            </div>
            <div class="form-group">
              <label for="emailInput">Email:</label>
              <input type="email" class="form-control" id="emailInput">
            </div>
            <div class="form-group">
              <label for="enderecoInput">Endereço:</label>
              <input type="text" class="form-control" id="enderecoInput">
            </div>
            <div class="form-group">
              <label for="cidadeInput">Cidade:</label>
              <select class="form-control" id="cidadeInput">
                <?php
                // Lista das cidades do Acre em ordem alfabética
                $cidadesAcre = array(
                  "Acrelândia",
                  "Assis Brasil",
                  "Brasiléia",
                  "Bujari",
                  "Capixaba",
                  "Cruzeiro do Sul",
                  "Epitaciolândia",
                  "Feijó",
                  "Jordão",
                  "Mâncio Lima",
                  "Manoel Urbano",
                  "Marechal Thaumaturgo",
                  "Plácido de Castro",
                  "Porto Acre",
                  "Porto Walter",
                  "Rio Branco",
                  "Rodrigues Alves",
                  "Santa Rosa do Purus",
                  "Sena Madureira",
                  "Senador Guiomard",
                  "Tarauacá",
                  "Xapuri"
                );

                // Ordena as cidades em ordem alfabética
                sort($cidadesAcre);

                // Itera sobre as cidades e cria as opções para o elemento select
                foreach ($cidadesAcre as $cidade) {
                  echo "<option value='$cidade'>$cidade</option>";
                }
                ?>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="botaoFecharModal">Fechar</button>
          <button id="botaoSalvar" type="button" class="btn btn-primary">Salvar</button>
        </div>

      </div>
    </div>
  </div>
  <!-- FIM Modal  Atualizar -->



  <!-- Footer -->
  <?php include 'html/footer.php'; ?>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
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

  <script>
$(document).ready(function () {
    // Fazendo requisição AJAX para carregar os dados do arquivo JSON
    $.getJSON('controle/busca_dados_autuado.php', function (dados) {
        // Inicializa a DataTable com os dados carregados do arquivo JSON
        var tabela = $('#tabela-dados').DataTable({
            "processing": true, // Exibe uma mensagem de carregamento durante o processamento
            "data": dados, // Dados da tabela
            "columns": [
                { "data": "id_autuado" },
                { "data": "cpf" },
                { "data": "nome" },
                { "data": "telefone" },
                { "data": "email" },
                { "data": "endereco" },
                { "data": "cidade" },
                { "data": null, "defaultContent": "<button class='btn btn-warning btn-editar bi bi-pencil'></button>" }, // Coluna de seleção com botão de edição
                { "data": null, "defaultContent": "<center><button class='btn btn-success btn-registrar bi bi-clipboard-plus'></button></center>" } // Coluna de seleção com botão de registro
            ]
        });

        // Evento de clique no botão de registro
        $('#tabela-dados').on('click', '.btn-registrar', function() {
            // Captura os dados da linha selecionada
            var data = tabela.row($(this).parents('tr')).data();

            // Cria um formulário dinâmico para enviar os dados via POST
            var form = $('<form action="cadastro_autuacao.php" method="post">' +
                '<input type="hidden" name="id_autuado" value="' + data.id_autuado + '" />' +
                '<input type="hidden" name="cpf" value="' + data.cpf + '" />' +
                '<input type="hidden" name="nome" value="' + data.nome + '" />' +
                '<input type="hidden" name="telefone" value="' + data.telefone + '" />' +
                '<input type="hidden" name="email" value="' + data.email + '" />' +
                '<input type="hidden" name="endereco" value="' + data.endereco + '" />' +
                '<input type="hidden" name="cidade" value="' + data.cidade + '" />' +
                '</form>');

            // Adiciona o formulário à página e o envia
            $('body').append(form);
            form.submit();
        });
    });
});

  </script>



  <script>
    // Seleciona a tabela
    var tabela = document.getElementById('tabela-dados');

    // Adiciona um ouvinte de eventos de clique à tabela
    tabela.addEventListener('click', function (event) {
      // Verifica se o elemento clicado é um botão de edição
      if (event.target.classList.contains('btn-editar')) {
        // Obtém a linha correspondente ao botão clicado
        var linha = event.target.parentElement.parentElement;

        // Obtém os dados da linha
        var id = linha.cells[0].innerText;
        var cpf = linha.cells[1].innerText;
        var nome = linha.cells[2].innerText;
        var telefone = linha.cells[3].innerText;
        var email = linha.cells[4].innerText;
        var endereco = linha.cells[5].innerText;
        var cidade = linha.cells[6].innerText;

        // Preenche os campos do formulário com os dados obtidos
        document.getElementById('idInput').value = id;
        document.getElementById('cpfInput').value = cpf;
        document.getElementById('nomeInput').value = nome;
        document.getElementById('telefoneInput').value = telefone;
        document.getElementById('emailInput').value = email;
        document.getElementById('enderecoInput').value = endereco;
        document.getElementById('cidadeInput').value = cidade;

        var modal = new bootstrap.Modal(editarModal);
        modal.show();

        // Exibe os dados na tela
        // var dadosSelecionados = document.getElementById('dados-selecionados');
        // dadosSelecionados.innerHTML = '<p>CPF: ' + cpf + '</p>' +
        //                               '<p>Nome: ' + nome + '</p>' +
        //                               '<p>Telefone: ' + telefone + '</p>' +
        //                               '<p>Email: ' + email + '</p>' +
        //                               '<p>Endereço: ' + endereco + '</p>' +
        //                               '<p>Cidade: ' + cidade + '</p>';
      }
    });



    // Função para fechar o modal quando o botão "Fechar" dentro do modal é clicado
    function fecharModal() {
      var modalElement = document.getElementById('editarModal');
      var modal = bootstrap.Modal.getInstance(modalElement);
      modal.hide();
    }

    // Seleciona o botão "Fechar" dentro do modal
    var botaoFecharModal = document.getElementById('botaoFecharModal');

    // Adiciona um ouvinte de evento para fechar o modal quando o botão "Fechar" dentro do modal for clicado
    botaoFecharModal.addEventListener('click', fecharModal);


    // Adiciona máscara de telefone e permite apenas números
    $('#telefoneInput').on('input', function () {
      // Remove todos os caracteres que não são números
      var sanitized = $(this).val().replace(/[^0-9]/g, '');
      // Formata o número de telefone
      var formatted = '';
      if (sanitized.length > 2) {
        formatted = '(' + sanitized.substring(0, 2) + ')';
        if (sanitized.length > 7) {
          formatted += sanitized.substring(2, 7) + '-' + sanitized.substring(7, 11);
        } else {
          formatted += sanitized.substring(2);
        }
      } else {
        formatted = sanitized;
      }
      // Atualiza o valor do campo
      $(this).val(formatted);
    });

    // Converte o endereço em letras maiúsculas enquanto você digita
    document.getElementById('enderecoInput').addEventListener('input', function () {
      this.value = this.value.toUpperCase();
    });

    // Converte o endereço em letras maiúsculas enquanto você digita
    document.getElementById('emailInput').addEventListener('input', function () {
      this.value = this.value.toUpperCase();
    });




    document.addEventListener('DOMContentLoaded', function () {
      // Adiciona um ouvinte de evento para o clique no botão "Salvar"
      document.getElementById('botaoSalvar').addEventListener('click', function () {
        // Obtém os valores dos campos do formulário
        var id_autuado = document.getElementById('idInput').value;
        var cpf = document.getElementById('cpfInput').value;
        var nome = document.getElementById('nomeInput').value;
        var telefone = document.getElementById('telefoneInput').value;
        var email = document.getElementById('emailInput').value;
        var endereco = document.getElementById('enderecoInput').value;
        var cidade = document.getElementById('cidadeInput').value;

        // Cria um objeto FormData
        var formData = new FormData();
        formData.append('id_autuado', id_autuado);
        formData.append('cpf', cpf);
        formData.append('nome', nome);
        formData.append('telefone', telefone);
        formData.append('email', email);
        formData.append('endereco', endereco);
        formData.append('cidade', cidade);

        // Envia os dados via POST para a página atualizar_dados_autuado.php
        fetch('controle/atualizar_dados_autuado.php', {
          method: 'POST',
          body: formData
        })
          .then(function (response) {
            if (!response.ok) {
              throw new Error('Erro ao enviar os dados');
            }
            return response.text();
          })
          .then(function (data) {
            // Exibe a mensagem de retorno

            // Fecha o modal
            var modalElement = document.getElementById('editarModal');
            var modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();

            Swal.fire({
              title: "Dados atualizados com sucesso!",
              text: "",
              icon: "success"
            }).then((result) => {
              if (result.isConfirmed) {
                // Recarrega a página
                location.reload();
              }
            });

          })
          .catch(function (error) {
            console.error('Erro:', error);
          });
      });
    });


  </script>

</body>

</html>