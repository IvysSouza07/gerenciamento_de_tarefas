<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $status = trim($_POST['status']);
    $prioridade = trim($_POST['prioridade']);
    $data_vencimento = trim($_POST['data_vencimento']);

    if ($id && $titulo && $descricao && $status && $prioridade && $data_vencimento) {
        $stmt = $conn->prepare("UPDATE tarefas SET titulo=?, descricao=?, status=?, prioridade=?, data_vencimento=? WHERE id=?");
        $stmt->bind_param('sssssi', $titulo, $descricao, $status, $prioridade, $data_vencimento, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php');
        exit;
    } else {
        $erro = "Preencha todos os campos corretamente.";
    }
}

// Buscar dados da tarefa para preencher o formulário
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
$tarefa = null;
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM tarefas WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tarefa = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Tarefa</h1>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </header>
        <main>
            <?php if ($tarefa): ?>
            <form method="POST" action="editar.php?id=<?= $tarefa['id'] ?>" class="form-task">
                <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($tarefa['titulo']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required><?= htmlspecialchars($tarefa['descricao']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="pendente" <?= $tarefa['status']=='pendente'?'selected':'' ?>>Pendente</option>
                        <option value="em_andamento" <?= $tarefa['status']=='em_andamento'?'selected':'' ?>>Em Andamento</option>
                        <option value="concluida" <?= $tarefa['status']=='concluida'?'selected':'' ?>>Concluída</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prioridade">Prioridade:</label>
                    <select id="prioridade" name="prioridade" required>
                        <option value="baixa" <?= $tarefa['prioridade']=='baixa'?'selected':'' ?>>Baixa</option>
                        <option value="media" <?= $tarefa['prioridade']=='media'?'selected':'' ?>>Média</option>
                        <option value="alta" <?= $tarefa['prioridade']=='alta'?'selected':'' ?>>Alta</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="data_vencimento">Data de Vencimento:</label>
                    <input type="date" id="data_vencimento" name="data_vencimento" value="<?= htmlspecialchars($tarefa['data_vencimento']) ?>" required>
                </div>
                <button type="submit" id="btn-marg" class="btn btn-primary">Salvar</button>
            </form>
            <?php else: ?>
                <p>Tarefa não encontrada.</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>