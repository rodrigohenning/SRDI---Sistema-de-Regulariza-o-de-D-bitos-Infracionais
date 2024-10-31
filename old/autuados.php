<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Cabeçalho  -->
    <?php include 'header.php'; ?>

   
    <!-- Inclua a biblioteca DataTables -->
    <script src="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 0.5px solid #2a26261f;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body>

    <!-- Barra lateral (MENU)  -->
    <?php include 'sidebar.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h1 class="mt-4"><b>Dashboard</b></h1>
            <div class="panel">
                <p>Aqui está o conteúdo do Dashboard.</p>

                <table id="tabela-dados" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aqui os dados serão inseridos dinamicamente -->
                    </tbody>
                </table>

                <script>
                    $(document).ready(function () {
                        // Inicializa a DataTable
                        $('#tabela-dados').DataTable({
                            "processing": true, // Exibe uma mensagem de carregamento durante o processamento
                            "serverSide": false, // Processamento será feito no cliente
                            "ajax": {
                                "url": "controle/busca_dados_autuado.php", // URL para o script que retorna os dados JSON
                            },
                            "columns": [
                                { "data": "id_autuado" },
                                { "data": "cpf" },
                                { "data": "nome" },
                                { "data": "telefone" },
                                { "data": "email" },
                                { "data": "endereco" },
                                { "data": "cidade" }
                            ],
                            // Adiciona os botões de exportação
                            "buttons": [
                                'excelHtml5' // Botão de exportar para Excel
                            ]
                        });
                    });
                </script>


            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

    <!-- Footer -->
    <?php include 'footer.php'; ?>

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

    <!-- Scripts do Bootstrap Bundle com Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


</body>

</html>
