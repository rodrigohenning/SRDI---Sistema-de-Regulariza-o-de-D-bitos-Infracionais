<?php
// Configurações do banco de dados
include('../include/conexao.php');

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}

// Função para gerar uma chave única de 8 caracteres (letras maiúsculas e números)
function gerarChaveUnica($pdo) {
    do {
        $chave = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);
        $query = "SELECT id_boleto FROM boletos WHERE chave_unica = :chave";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['chave' => $chave]);
    } while ($stmt->fetch());

    return $chave;
}

// Função para inserir dados na tabela emissao_boleto
function inserirEmissaoBoleto($pdo, $dados) {
    $query = "INSERT INTO emissao_boleto (id_usuario, id_autuado, sei, cpf, valor, desconto, parcelar, quantidade_parcelas, valor_entrada) 
              VALUES (:id_usuario, :id_autuado, :sei, :cpf, :valor, :desconto, :parcelar, :quantidade_parcelas, :valor_entrada)";
    $stmt = $pdo->prepare($query);
    $stmt->execute($dados);
    return $pdo->lastInsertId();
}

// Função para inserir dados na tabela boletos
function inserirBoleto($pdo, $id_emissao, $id_autuacao, $valor, $numero_parcela, $data_vencimento, $chave_unica) {
    $query = "INSERT INTO boletos (chave_unica, id_emissao, id_autuacao, valor, numero_parcela, data_vencimento, status) 
              VALUES (:chave_unica, :id_emissao, :id_autuacao, :valor, :numero_parcela, :data_vencimento, 'pendente')";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'chave_unica' => $chave_unica,
        'id_emissao' => $id_emissao,
        'id_autuacao' => $id_autuacao,
        'valor' => $valor,
        'numero_parcela' => $numero_parcela,
        'data_vencimento' => $data_vencimento
    ]);
}

// Buscar nome do contribuinte com base no id_autuacao
function buscarNomeContribuintePorAutuacao($pdo, $id_autuacao) {
    $query = "SELECT da.nome 
              FROM autuacoes a
              JOIN dados_autuado da ON a.id_autuado = da.id_autuado
              WHERE a.id_autuacao = :id_autuacao";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id_autuacao' => $id_autuacao]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['nome'];
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $id_usuario = $_SESSION['id_usuario'];
    $id_autuacao = htmlspecialchars($_POST['id']);
    $sei = htmlspecialchars($_POST['sei']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $valor = htmlspecialchars($_POST['valor']);
    $desconto = isset($_POST['desconto']) ? htmlspecialchars($_POST['desconto']) : 0;
    $parcelar = htmlspecialchars($_POST['parcelar']);
    $quantidade_parcelas = isset($_POST['quantidade_parcelas']) ? htmlspecialchars($_POST['quantidade_parcelas']) : 1;
    $valor_entrada = isset($_POST['valor_entrada']) ? htmlspecialchars($_POST['valor_entrada']) : 0;

    // Calcular valor com desconto
    $valor_com_desconto = $valor * (1 - $desconto / 100);

    // Buscar nome do contribuinte com base no id_autuacao
    $nome_contribuinte = buscarNomeContribuintePorAutuacao($pdo, $id_autuacao);

    // Inserir dados na tabela emissao_boleto
    $dados_emissao = [
        'id_usuario' => $id_usuario,
        'id_autuado' => $id_autuacao,
        'sei' => $sei,
        'cpf' => $cpf,
        'valor' => $valor_com_desconto,
        'desconto' => $desconto,
        'parcelar' => $parcelar,
        'quantidade_parcelas' => $quantidade_parcelas,
        'valor_entrada' => $valor_entrada
    ];
    $id_emissao = inserirEmissaoBoleto($pdo, $dados_emissao);

    $boletos_urls = [];
    $nome_formatado = str_replace(' ', '+', $nome_contribuinte);

    // Inserir dados na tabela boletos e gerar URL para cada boleto
    if ($parcelar === 'sim') {
        $valor_restante = $valor_com_desconto - $valor_entrada;
        $valor_parcela = $valor_restante / $quantidade_parcelas;

        // Boleto da entrada
        $data_vencimento = date('Ymd', strtotime("+30 days"));
        $chave_unica = gerarChaveUnica($pdo);
        inserirBoleto($pdo, $id_emissao, $id_autuacao, $valor_entrada, 0, $data_vencimento, $chave_unica);
        $mensagem = "$sei, Negociação: Entrada";
        $boletos_urls[] = "http://sefaznet.ac.gov.br/sefazonline/servlet/agcbsispass?$data_vencimento,00.726.078/0001-98,82,4,$chave_unica,$nome_formatado,{$valor_entrada},0,0,$mensagem";

        // Boletos das parcelas
        for ($i = 1; $i <= $quantidade_parcelas; $i++) {
            $data_vencimento = date('Ymd', strtotime("+$i month + 30 days"));
            $chave_unica = gerarChaveUnica($pdo);
            inserirBoleto($pdo, $id_emissao, $id_autuacao, $valor_parcela, $i, $data_vencimento, $chave_unica);
            $mensagem = "$sei, Negociação: Parcela $i/$quantidade_parcelas";
            $boletos_urls[] = "http://sefaznet.ac.gov.br/sefazonline/servlet/agcbsispass?$data_vencimento,00.726.078/0001-98,82,4,$chave_unica,$nome_formatado,{$valor_parcela},0,0,$mensagem";
        }
    } else {
        $data_vencimento = date('Ymd', strtotime("+30 days"));
        $chave_unica = gerarChaveUnica($pdo);
        inserirBoleto($pdo, $id_emissao, $id_autuacao, $valor_com_desconto, 1, $data_vencimento, $chave_unica);
        $mensagem = "$sei, Negociação: Parcela única";
        $boletos_urls[] = "http://sefaznet.ac.gov.br/sefazonline/servlet/agcbsispass?$data_vencimento,00.726.078/0001-98,82,4,$chave_unica,$nome_formatado,{$valor_com_desconto},0,0,$mensagem";
    }

    // Abrir cada URL de boleto em uma nova aba
    echo "<script>";
    foreach ($boletos_urls as $url) {
        echo "window.open('$url', '_blank');";
    }
    echo "</script>";

    echo "Boletos emitidos com sucesso!";
} else {
    echo "Método de requisição inválido.";
}
?>
