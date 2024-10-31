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

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados via POST
    $idAutuado = $_POST["id_autuado"];
    $numProcesso = $_POST["num_processo"];
    $dataAutuacao = $_POST["data_autuacao"];
    $valorAutuacao = $_POST["valor_autuacao"];

    
// Remove os pontos de milhar para evitar problemas na conversão
$valorAutuacao = str_replace(".", "", $valorAutuacao);


// Substitui vírgulas por pontos para garantir que seja um número decimal válido
$valorAutuacao = str_replace(",", ".", $valorAutuacao);


    // Configurações do banco de dados
    include('../../include/conexao.php');

    // Conexão com o banco de dados usando PDO
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Erro ao conectar com o banco de dados: " . $e->getMessage());
    }

    // Executa a consulta SQL para inserir os dados
    try {
        $query = "INSERT INTO autuacoes (n_proc_sei, valor_multa, data_atuacao, id_autuado) VALUES (:numProcesso, :valorAutuacao, :dataAutuacao, :idAutuado)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':numProcesso', $numProcesso);
        $stmt->bindParam(':valorAutuacao', $valorAutuacao);
        $stmt->bindParam(':dataAutuacao', $dataAutuacao);
        $stmt->bindParam(':idAutuado', $idAutuado);
        $stmt->execute();

        // Obtém o ID da autuação inserida
        $idAutuacao = $pdo->lastInsertId();

        // Busca os dados do status 1
        $queryStatus = "SELECT `id_status`, `descricao`, `prazo_dias` FROM `status` WHERE `id_status` = 1";
        $stmtStatus = $pdo->query($queryStatus);
        $status = $stmtStatus->fetch(PDO::FETCH_ASSOC);
        
        // Calcula a data prazo
        $dataAtual = date('Y-m-d');
        $prazoDias = $status['prazo_dias'];
        $dataPrazo = date('Y-m-d H:i:s', strtotime($dataAtual . ' + ' . $prazoDias . ' days'));

        // Insere na tabela mov_autuacoes
        $idUsuario = $_SESSION['id_usuario']; // Supondo que você armazene o ID do usuário na sessão
        $idStatus = $status['id_status'];

        $queryMov = "INSERT INTO mov_autuacoes (id_autuacao, data, data_prazo, id_status, descricao, id_usuario) VALUES (:idAutuacao, NOW(), :dataPrazo, :idStatus, 'Descrição', :idUsuario)";
        $stmtMov = $pdo->prepare($queryMov);
        $stmtMov->bindParam(':idAutuacao', $idAutuacao);
        $stmtMov->bindParam(':dataPrazo', $dataPrazo);
        $stmtMov->bindParam(':idStatus', $idStatus);
        $stmtMov->bindParam(':idUsuario', $idUsuario);
        $stmtMov->execute();

        // Retorna uma mensagem de sucesso para a página anterior
        //echo "Dados cadastrados com sucesso";
        header("Location: ../autuacoes.php?mensagem=OK");
        exit();
    } catch(PDOException $e) {
        // Retorna uma mensagem de erro para a página anterior
        header("Location: ../cadastro_autuado.php?mensagem=Erro ao cadastrar os dados: " . $e->getMessage());
        exit();
    }
} else {
    // Se os dados não foram enviados via POST, redireciona para a página anterior
    header("Location: pagina_anterior.php");
    exit();
}
?>
