<?php
require 'db.php';

// Filtros
$status = isset($_GET['status']) ? $_GET['status'] : '';
$prioridade = isset($_GET['prioridade']) ? $_GET['prioridade'] : '';

// Consulta segura com prepared statement
$sql = "SELECT * FROM tarefas WHERE 1=1";
$params = [];
$types = '';
if ($status) {
    $sql .= " AND status = ?";
    $params[] = $status;
    $types .= 's';
}
if ($prioridade) {
    $sql .= " AND prioridade = ?";
    $params[] = $prioridade;
    $types .= 's';
}
$sql .= " ORDER BY data_criacao DESC";
if ($params) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $result = $conn->query($sql);
}

$tarefas = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Escapar dados para evitar XSS
        foreach ($row as $k => $v) {
            $row[$k] = htmlspecialchars($v, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        $tarefas[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciador de Tarefas</h1>
            <a href="adicionar.php" class="btn btn-primary">+ Nova Tarefa</a>
        </header>
        <main>
            <section class="filters">
                <form method="GET" action="index.php">
                    <div class="filter-group">
                        <label for="status">Status:</label>
                        <select id="status" name="status">
                            <option value="">Todos</option>
                            <option value="pendente" <?= $status=='pendente'?'selected':'' ?>>Pendente</option>
                            <option value="em_andamento" <?= $status=='em_andamento'?'selected':'' ?>>Em Andamento</option>
                            <option value="concluida" <?= $status=='concluida'?'selected':'' ?>>Concluída</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="prioridade">Prioridade:</label>
                        <select id="prioridade" name="prioridade">
                            <option value="">Todas</option>
                            <option value="baixa" <?= $prioridade=='baixa'?'selected':'' ?>>Baixa</option>
                            <option value="media" <?= $prioridade=='media'?'selected':'' ?>>Média</option>
                            <option value="alta" <?= $prioridade=='alta'?'selected':'' ?>>Alta</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-filter">Filtrar</button>
                </form>
            </section>
            <section class="tasks-list">
                <?php if (count($tarefas) > 0): ?>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <div class="task-item">
                            <div class="task-header">
                                <h3><?= htmlspecialchars($tarefa['titulo']) ?></h3>
                                <div class="task-badges">
                                    <span class="badge badge-status badge-<?= htmlspecialchars($tarefa['status']) ?>">
                                        <?= ucfirst(str_replace('_', ' ', $tarefa['status'])) ?>
                                    </span>
                                    <span class="badge badge-priority badge-<?= htmlspecialchars($tarefa['prioridade']) ?>">
                                        <?= ucfirst($tarefa['prioridade']) ?>
                                    </span>
                                </div>
                            </div>
                            <p class="task-description"><?= htmlspecialchars($tarefa['descricao']) ?></p>
                            <div class="task-meta">
                                <span class="meta-date">Criada: <?= date('d/m/Y', strtotime($tarefa['data_criacao'])) ?></span>
                                <span class="meta-date">Vencimento: <?= date('d/m/Y', strtotime($tarefa['data_vencimento'])) ?></span>
                            </div>
                            <div class="task-actions">
                                <a href="editar.php?id=<?= $tarefa['id'] ?>" class="btn btn-secondary">Editar</a>
                                <form method="POST" action="excluir.php" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <h2>Nenhuma tarefa encontrada</h2>
                        <p>Crie uma nova tarefa para começar</p>
                        <a href="adicionar.php" class="btn btn-primary">Criar Tarefa</a>
                    </div>
                <?php endif; ?>
            </section>
        </main>
        <footer>
            <p>&copy; 2025 Desenvolvido por Ivys Lima</p>
        </footer>
    </div>
</body>
</html>
