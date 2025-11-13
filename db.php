<?php
// Configuração de conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'crud_tarefas';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');
if ($conn->connect_error) {
    error_log('Erro na conexão: ' . $conn->connect_error);
    die('Erro ao conectar ao banco de dados.');
}
?>