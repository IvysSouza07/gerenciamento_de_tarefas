<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);
    $prioridade = trim($_POST['prioridade']);
    $data_criacao = date('Y-m-d');
    $data_vencimento = trim($_POST['data_vencimento']);

    if ($titulo && $descricao && $status && $prioridade && $data_vencimento) {
        $stmt = $conn->prepare("INSERT INTO tarefas (titulo, descricao, status, prioridade, data_criacao, data_vencimento) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $titulo, $descricao, $status, $prioridade, $data_criacao, $data_vencimento);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php');
        exit;
    } else {
        $erro = "Preencha todos os campos corretamente.";
    }
}
?>
<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);
    $prioridade = trim($_POST['prioridade']);
    $data_criacao = date('Y-m-d');
    $data_vencimento = trim($_POST['data_vencimento']);

    if ($titulo && $descricao && $status && $prioridade && $data_vencimento) {
        $stmt = $conn->prepare("INSERT INTO tarefas (titulo, descricao, status, prioridade, data_criacao, data_vencimento) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $titulo, $descricao, $status, $prioridade, $data_criacao, $data_vencimento);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php');
        exit;
    } else {
        $erro = "Preencha todos os campos corretamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Adicionar Nova Tarefa</h1>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </header>
        <main>
            <form method="POST" action="adicionar.php" class="form-task">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="pendente">Pendente</option>
                        <option value="em_andamento">Em Andamento</option>
                        <option value="concluida">Concluída</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prioridade">Prioridade:</label>
                    <select id="prioridade" name="prioridade" required>
                        <option value="baixa">Baixa</option>
                        <option value="media">Média</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="data_vencimento">Data de Vencimento:</label>
                    <input type="date" id="data_vencimento" name="data_vencimento" required>
                </div>
                <button type="submit" id="btn-marg" class="btn btn-primary">Adicionar</button>
            </form>
        </main>
    </div>
</body>
</html>