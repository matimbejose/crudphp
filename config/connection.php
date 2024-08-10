<?php

// Inicia a sessão se ela ainda não tiver sido iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define as constantes de conexão com o banco de dados dependendo do ambiente (local ou produção)
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Configurações para ambiente de desenvolvimento local
    define('HOSTNAME', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'epges326_crud');
} else {
    // Configurações para ambiente de produção (preencha com as informações corretas)
    define('HOSTNAME', '');
    define('USERNAME', '');
    define('PASSWORD', '');
    define('DATABASE', '');
}

try {
    // Cria o Data Source Name (DSN) para a conexão com o banco de dados
    $dsn = "mysql:host=" . HOSTNAME . ";dbname=" . DATABASE . ";charset=utf8mb4";
    // Define as opções para a conexão PDO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Define o modo de erro para lançar exceções
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Define o modo de busca padrão para associativo
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Desativa a emulação de consultas preparadas
    ];
    // Cria uma nova instância de PDO para a conexão com o banco de dados
    $pdo = new PDO($dsn, USERNAME, PASSWORD, $options);
} catch (PDOException $e) {
    // Encerra o script e exibe uma mensagem de erro se a conexão falhar
    die("Não foi possível conectar: " . $e->getMessage());
}
