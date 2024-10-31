<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- header  -->
    <?php include 'html/head.php'; ?>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>
<style>
    .campos-ocultos {
        display: none;
    }
</style>

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
                    <h4>Cadastro </h4>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-person-check-fill me-1"></i></span> Cadastro Autuado
                        </div>
                        <div class="card-body">
                            <!-- Formulário de cadastro -->
                            <form id="formularioModal">

                                <div class="mb-3 col-2">
                                    <div class="me-2">
                                        <label for="cpfInput" class="form-label">CPF:</label>
                                        <input type="text" class="form-control" id="cpfInput"
                                            placeholder="___.___.___-__" required>
                                        <small id="cpfHelp" class="form-text text-muted">Digite apenas os números do
                                            CPF.</small>
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2 d-block"
                                        id="botaoVerificar">Verificar</button>
                                </div>

                                <div class="mb-3 col-6 campos-ocultos">
                                    <label for="nomeInput" class="form-label" required>Nome Completo:*</label>
                                    <input type="text" class="form-control" id="nomeInput">
                                </div>
                                <div class="mb-3 col-2 campos-ocultos">
                                    <label for="telefoneInput" class="form-label">Telefone:</label>
                                    <input type="text" class="form-control" id="telefoneInput"
                                        placeholder="(__)_____-____">
                                </div>
                                <div class="mb-3 col-3 campos-ocultos">
                                    <label for="emailInput" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="emailInput">
                                </div>
                                <div class="mb-3 col-6 campos-ocultos">
                                    <label for="enderecoInput" class="form-label">Endereço:*</label>
                                    <input type="text" class="form-control" id="enderecoInput" required>
                                </div>
                                <div class="mb-3 col-2 campos-ocultos">
                                    <label for="cidadeInput" class="form-label">Cidade:*</label>
                                    <select class="form-control" id="cidadeInput">
                                        <?php
                                        // Lista das cidades do Acre em ordem alfabética
                                        $cidadesAcre = array(
                                            "--",
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
                                <div class="text-center campos-ocultos">
                                    <button type="button" class="btn btn-warning" id="botaoVoltar">Voltar</button>
                                    <button type="button" class="btn btn-danger" id="botaoLimpar">Limpar</button>
                                    <button type="button" class="btn btn-success" id="botaoSalvarFinal">Salvar</button>
                                </div>
                            </form>
                            <!-- Fim do formulário de cadastro -->
                        </div>
                    </div>
                </div>
            </div>


    </main>

    <!-- Footer -->
    <?php include 'html/footer.php'; ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/script.js"></script>

    <script>
        

        // Função para auto preencher os pontos e traço do CPF
        function autoPreencherCPF() {
            const cpfInput = document.getElementById('cpfInput');
            cpfInput.addEventListener('input', function () {
                let cpf = cpfInput.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
                cpf = cpf.substring(0, 11); // Garante que o CPF tenha no máximo 11 dígitos

                // Formata o CPF com os pontos e traço
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

                cpfInput.value = cpf; // Atualiza o valor do input com o CPF formatado
            });
        }

        // Chama a função quando o documento estiver carregado
        document.addEventListener('DOMContentLoaded', function () {
            autoPreencherCPF();
        });



        // Função para validar CPF
        function validarCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            if (cpf.length !== 11) return false;

            // Validação do CPF
            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let resto = 11 - (soma % 11);
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(9))) return false;

            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            resto = 11 - (soma % 11);
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(10))) return false;

            return true;
        }

        // Função para lidar com o clique no botão "Verificar"
        // Função para lidar com o clique no botão "Verificar"
        function verificarCPF() {
            const cpfInput = document.getElementById('cpfInput');
            const cpf = cpfInput.value;

            if (validarCPF(cpf)) {
                // Cria um objeto XMLHttpRequest para fazer a requisição AJAX
                const xhr = new XMLHttpRequest();

                // Configura a requisição
                xhr.open('POST', 'controle/verificar-cpf.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Define a função de callback a ser chamada quando a requisição estiver completa
                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        // Requisição bem-sucedida
                        const response = xhr.responseText;
                        // Exibe a mensagem retornada sem sair da página
                        //alert(response);
                        // Verifica a mensagem retornada e executa ações com base nela
                        if (response === 'CPF já cadastrado') {
                            Swal.fire({
                                title: "ERRO: CPF Já cadastrado!",
                                text: "CPF: " + cpf + "",
                                icon: "error"
                            });
                            // Aqui você pode executar outras ações, como limpar o campo CPF
                        } else {
                            // Resposta inválida
                            //alert(response);
                            Swal.fire({
                                title: "CPF válido!",
                                text: "",
                                icon: "success"
                            });
                            const camposOcultos = document.querySelectorAll('.campos-ocultos');
                            camposOcultos.forEach(function (element) {
                                element.style.display = 'block';
                            });
                            cpfInput.disabled = true;
                        }
                    } else {
                        // Erro na requisição
                        alert('Erro ao verificar CPF');
                    }
                };

                // Envia a requisição com o CPF como parâmetro
                xhr.send('cpf=' + encodeURIComponent(cpf));
            } else {
                Swal.fire({
                    title: "CPF inválido!",
                    text: "",
                    icon: "error"
                });
            }
        }


        // Chama a função de auto preenchimento do CPF quando o documento estiver carregado
        document.addEventListener('DOMContentLoaded', function () {
            autoPreencherCPF();

            // Adiciona um ouvinte de evento ao botão "Verificar"
            document.getElementById('botaoVerificar').addEventListener('click', function () {
                verificarCPF();
            });
        });


        // Seleciona o botão Limpar pelo id
        const botaoLimpar = document.getElementById('botaoLimpar');

        // Adiciona um ouvinte de evento para o evento de clique no botão Limpar
        botaoLimpar.addEventListener('click', function () {
            location.reload();
        });


        // Converte o endereço em letras maiúsculas enquanto você digita
        document.getElementById('nomeInput').addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });

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
        document.getElementById('emailInput').addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });

        // Converte o endereço em letras maiúsculas enquanto você digita
        document.getElementById('enderecoInput').addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });




        /* CADASTRAR NO BD */

        document.addEventListener('DOMContentLoaded', function () {
      // Adiciona um ouvinte de evento para o clique no botão "Salvar"
      document.getElementById('botaoSalvarFinal').addEventListener('click', function () {
        // Obtém os valores dos campos do formulário
        var cpf = document.getElementById('cpfInput').value;
        var nome = document.getElementById('nomeInput').value;
        var telefone = document.getElementById('telefoneInput').value;
        var email = document.getElementById('emailInput').value;
        var endereco = document.getElementById('enderecoInput').value;
        var cidade = document.getElementById('cidadeInput').value;

        // Cria um objeto FormData
        var formData = new FormData();
        formData.append('cpf', cpf);
        formData.append('nome', nome);
        formData.append('telefone', telefone);
        formData.append('email', email);
        formData.append('endereco', endereco);
        formData.append('cidade', cidade);

        // Envia os dados via POST para a página atualizar_dados_autuado.php
        fetch('controle/cadastrar_dados_autuado.php', {
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



    // Adiciona um ouvinte de evento para o clique no botão "Voltar"
document.getElementById('botaoVoltar').addEventListener('click', function() {
    // Redireciona para a página da lista de cadastros
    window.location.href = 'autuados.php';
});



document.addEventListener('DOMContentLoaded', function () {
    // Obtém o campo de nome e o botão "Salvar"
    var nomeInput = document.getElementById('nomeInput');
    var botaoSalvar = document.getElementById('botaoSalvarFinal');

    // Adiciona um ouvinte de evento de entrada ao campo de nome
    nomeInput.addEventListener('input', function () {
        // Verifica o comprimento do valor do campo de nome
        var nome = this.value.trim();

        // Habilita ou desabilita o botão "Salvar" com base no comprimento do valor do campo de nome
        botaoSalvar.disabled = (nome.length === 0);
    });

    // Inicialmente, desabilita o botão "Salvar" se o campo de nome estiver vazio
    botaoSalvar.disabled = true;
});







    </script>
</body>

</html>