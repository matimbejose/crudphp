<?php
// Inclui o arquivo de inicialização que define constantes e configurações básicas
include_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

// Inclui a conexão com o banco de dados
include_once(ROOT_PATH . 'config/connection.php');

// Verifica se a variável $pdo está definida após a inclusão do arquivo de conexão
if (!isset($pdo)) {
    die('Erro ao conectar ao banco de dados');
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitiza e valida os dados recebidos do formulário
    $crud_id = isset($_POST['crud_id']) ? filter_var($_POST['crud_id'], FILTER_SANITIZE_NUMBER_INT) : null;
    $nome = isset($_POST['nome']) ? filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
    $whatsapp = isset($_POST['whatsapp']) ? filter_var($_POST['whatsapp'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
    $contato2 = isset($_POST['contato2']) ? filter_var($_POST['contato2'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
    $cep = isset($_POST['cep']) ? filter_var($_POST['cep'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
    $cpf = isset($_POST['cpf']) ? filter_var($_POST['cpf'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
    $como_soube_empresa = isset($_POST['como_soube_empresa']) ? filter_var($_POST['como_soube_empresa'], FILTER_SANITIZE_SPECIAL_CHARS) : null;

    $action = isset($_POST['action']) ? $_POST['action'] : '';

    // Ação para buscar um registro específico
    if ($action === 'get' && $crud_id) {
        $query = "SELECT * FROM tbl_crud WHERE id = ?"; // Prepara a consulta SQL
        $stmt = $pdo->prepare($query);
        $stmt->execute([$crud_id]); // Executa a consulta com o ID do registro
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Obtém o resultado da consulta


        // Retorna o resultado como JSON
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Registro não encontrado']);
        }
        exit; // Encerra o script após retornar o resultado
    }

    // Ação para criar ou atualizar um registro
    if ($action === 'create' || $action === 'update') {
        if ($nome && $cep !== false) { // Verifica se os campos obrigatórios estão preenchidos
            if ($crud_id) {
                // Atualiza um registro existente
                $query = "UPDATE tbl_crud SET nome = ?, whatsapp = ?, whatsapp = ?,contato2 = ?, cpf = ?, cep = ?, como_soube_empresa = ?, updated_at = NOW() WHERE id = ?";
                $params = [$nome, $whatsapp, $contato2, $cpf, $cep, $como_soube_empresa, $crud_id];
            } else {
                // Insere um novo registro
                $query = "INSERT INTO tbl_crud (nome, whatsapp,contato2,cpf,cep,como_soube_empresa,created_at) VALUES (?, ?, ?,?,?,?,NOW())";

                // var_dump($query);
                $params = [$nome, $whatsapp, $contato2, $cpf, $cep, $como_soube_empresa];
            }

            $stmt = $pdo->prepare($query);
            if ($stmt->execute($params)) {
                $_SESSION['msg'] = $crud_id ? "Dados do CRUD atualizados com sucesso!" : "CRUD criado com sucesso!";
                $_SESSION['msg_type'] = 'success';
            } else {
                $_SESSION['msg'] = "Ocorreu um erro ao processar sua solicitação.";
                $_SESSION['msg_type'] = 'error';
            }
        } else {
            $_SESSION['msg'] = "Por favor, preencha todos os campos obrigatórios corretamente.";
            $_SESSION['msg_type'] = 'warning';
        }
    } else if ($action === 'delete' && $crud_id) {
        // Ação para apagar um registro
        $query = "DELETE FROM tbl_crud WHERE id = ?";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$crud_id])) {
            $_SESSION['msg'] = "Registro apagado com sucesso!";
            $_SESSION['msg_type'] = 'success';
            echo json_encode(['success' => true]);
        } else {
            $_SESSION['msg'] = "Ocorreu um erro ao apagar o registro.";
            $_SESSION['msg_type'] = 'error';
            echo json_encode(['success' => false, 'message' => 'Ocorreu um erro ao apagar o registro.']);
        }
        exit;
    }

    // Redireciona para a página principal após a operação
    header('Location: ./');
    exit;
} else {
    // Define uma mensagem de erro na sessão se o método da solicitação for inválido
    $_SESSION['msg'] = "Método de solicitação inválido.";
    $_SESSION['msg_type'] = 'error';
    header('Location: ./');
    exit;
}
