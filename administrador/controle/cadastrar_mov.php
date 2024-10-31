<?php

// Inicia a sessão para obter o ID do usuário
session_start();

// Verifica se o ID do usuário está definido na sessão
if(isset($_SESSION['id_usuario'])) {
    $idUsuario = $_SESSION['id_usuario'];
} else {
    // Redireciona para a página anterior se o ID do usuário não estiver definido na sessão
    header("Location: pagina_anterior.php");
    exit();
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados via POST e sanitiza-os (se necessário)
    $status = $_POST['status']; // Aqui você pode realizar a validação ou sanitização dos dados, se necessário
    $descricao = $_POST['descricao']; // Mesma coisa aqui
    $idAutuacao = $_POST['id_autuacao']; // E aqui também

    // Inclui o arquivo de configuração do banco de dados
    include('../../include/conexao.php');

    try {
        // Conexão com o banco de dados usando PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obter o prazo em dias do status selecionado
        $consultaStatus = $pdo->prepare("SELECT prazo_dias FROM status WHERE id_status = :status");
        $consultaStatus->bindParam(':status', $status);
        $consultaStatus->execute();
        $prazo = $consultaStatus->fetchColumn();

        // Calcula a data de prazo somando o prazo em dias à data atual
        $dataPrazo = date('Y-m-d', strtotime("+$prazo days"));

        // Inicia uma transação
        $pdo->beginTransaction();

        // Executa a consulta SQL para inserir os dados na tabela mov_autuacoes
        $query = "INSERT INTO mov_autuacoes (id_autuacao, data, data_prazo, id_status, descricao, id_usuario) 
          VALUES (:idAutuacao, NOW(), :dataPrazo, :status, :descricao, :idUsuario)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idAutuacao', $idAutuacao);
        $stmt->bindParam(':dataPrazo', $dataPrazo);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();

        // Confirma a transação
        $pdo->commit();

        // Retorna uma resposta JSON indicando sucesso
        echo json_encode(array("success" => true, "message" => "Movimentação cadastrada com sucesso."));

    } catch(PDOException $e) {
        // Desfaz a transação em caso de erro
        $pdo->rollBack();

        // Retorna uma resposta JSON indicando erro
        echo json_encode(array("success" => false, "message" => "Erro ao cadastrar a movimentação: " . $e->getMessage()));
    }
} else {
    // Se os dados não foram enviados via POST, retorna uma resposta JSON indicando erro
    echo json_encode(array("success" => false, "message" => "Nenhum dado foi enviado."));
}

?>
