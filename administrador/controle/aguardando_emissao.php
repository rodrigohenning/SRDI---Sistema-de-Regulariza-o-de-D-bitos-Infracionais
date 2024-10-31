<?php

// Configurações do banco de dados
include('../../include/conexao.php');

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}

// Consulta para selecionar os dados da tabela 'autuacoes' com contagem regressiva em dias e status
$query = "SELECT autuacoes.id_autuacao, autuacoes.n_proc_sei, autuacoes.valor_multa, autuacoes.data_atuacao,
          dados_autuado.cpf, dados_autuado.nome, dados_autuado.telefone, dados_autuado.email, 
          dados_autuado.endereco, dados_autuado.cidade,
          ultima_mov.data_prazo,
          DATEDIFF(ultima_mov.data_prazo, NOW()) AS dias_restantes,
          status.descricao AS status
          FROM autuacoes
          INNER JOIN dados_autuado ON autuacoes.id_autuado = dados_autuado.id_autuado
          INNER JOIN (
              SELECT id_autuacao, MAX(id_mov) AS max_id_mov
              FROM mov_autuacoes
              GROUP BY id_autuacao
          ) AS ultima_mov_info ON autuacoes.id_autuacao = ultima_mov_info.id_autuacao
          INNER JOIN mov_autuacoes AS ultima_mov ON ultima_mov.id_autuacao = ultima_mov_info.id_autuacao AND ultima_mov.id_mov = ultima_mov_info.max_id_mov
          INNER JOIN status ON ultima_mov.id_status = status.id_status
          WHERE status.id_status = 2
          GROUP BY autuacoes.id_autuacao;";


try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro ao executar a consulta: " . $e->getMessage());
}

// Retornar os resultados no formato JSON
header('Content-Type: application/json');
echo json_encode($resultados);

?>
