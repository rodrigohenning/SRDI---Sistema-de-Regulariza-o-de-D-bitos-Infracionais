<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Cabeçalho -->
    <?php include 'header.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>

</head>

<body>

    <!-- Barra lateral (MENU) -->
    <?php include 'sidebar.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <h1 class="mt-4"><b>Cadastro de Autuado</b></h1>
            <div class="panel">
                <p>Preencha o formulário abaixo para cadastrar um novo autuado.</p>

                <!-- Formulário de Cadastro -->
                <form id="form-cadastro">
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" required>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Endereço" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-control" required>
                            <option value="">Selecione a cidade</option>
                            <!-- Aqui você pode incluir as opções dinamicamente com PHP -->
                            <option value="Rio Branco">Rio Branco</option>
                            <!-- Adicione outras cidades aqui -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
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

        // Máscara para o CPF
        $('#cpf').mask('000.000.000-00', {reverse: true});

        // Máscara para o telefone
        $('#telefone').mask('(00) 00000-0000');

        // Máscara para o nome (todas as letras em maiúsculas)
        $('#nome').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });

        // Máscara para o endereço (todas as letras em maiúsculas)
        $('#endereco').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Máscara para input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>



</body>

</html>
