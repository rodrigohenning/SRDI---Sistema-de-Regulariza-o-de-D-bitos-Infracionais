<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Inclua os cabeçalhos necessários -->
    <?php include 'html/head.php'; ?>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <?php include 'controle/funcoes.php'; ?>
</head>
<style>
    .campos-ocultos {
        display: none;
    }
</style>

<body>
    <!-- Barra de navegação superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <?php include 'html/nav.php'; ?>
    </nav>
    <!-- Fim da barra de navegação superior -->

    <!-- Menu -->
    <?php include 'html/menu.php'; ?>
    <!-- Fim do menu -->

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4>Cadastro</h4>
                </div>
            </div>

            <!-- Dados do Autuado -->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Dados do Autuado
                        </div>
                        <div class="card-body">
                            <?php
                            // Verifica se os dados foram enviados via POST
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Obtém os dados enviados via POST
                                $id_autuado = $_POST["id_autuado"];
                                $cpf = $_POST["cpf"];
                                $nome = $_POST["nome"];
                                $telefone = $_POST["telefone"];
                                $email = $_POST["email"];
                                $endereco = $_POST["endereco"];
                                $cidade = $_POST["cidade"];

                                // Exibe os dados em um card
                                echo "<p>ID Autuado: $id_autuado</p>";
                                echo "<p>CPF: $cpf</p>";
                                echo "<p>Nome: $nome</p>";
                                echo "<p>Telefone: $telefone</p>";
                                echo "<p>Email: $email</p>";
                                echo "<p>Endereço: $endereco</p>";
                                echo "<p>Cidade: $cidade</p>";
                            } else {
                                // Se não foram enviados dados via POST, exibe uma mensagem de erro
                                echo "Erro: Nenhum dado foi recebido.";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim dos dados do Autuado -->

            <!-- Formulário para inserir autuação -->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            Inserir Autuação
                        </div>
                        <div class="card-body">
                            <form action="controle/cadastrar_autuacao.php" method="post">
                                <input type="hidden" name="id_autuado" value="<?php echo $id_autuado; ?>">
                                <div class="mb-3">
                                    <label for="num_processo">Nº Processo SEI:</label>
                                    <input type="text" class="form-control" id="num_processo" name="num_processo"
                                        placeholder="____.______.____/____-__" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="data_autuacao">Data da Autuação:</label>
                                        <input type="date" class="form-control" id="data_autuacao" name="data_autuacao"
                                            required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="valor_autuacao" class="form-label">Valor da Autuação:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">R$</span>
                                            <input type="text" class="form-control" id="valor_autuacao"
                                                name="valor_autuacao" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-info" id="botaoVoltar">Voltar</button>
                                    <button type="submit" class="btn btn-danger"
                                        id="botaoSalvarFinal">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim do formulário para inserir autuação -->
        </div>
    </main>

    <!-- Rodapé -->
    <?php include 'html/footer.php'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/script.js"></script>

    <!-- Adicionando máscara de data e dinheiro -->
    <script src="js/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#valor_autuacao').mask('#.##0,00', { reverse: true });
        });
    </script>

    <script>
        // Adiciona um ouvinte de evento para o clique no botão "Voltar"
        document.getElementById('botaoVoltar').addEventListener('click', function () {
            // Redireciona para a página da lista de cadastros
            window.location.href = 'autuacoes.php';
        });

    </script>



</body>

</html>