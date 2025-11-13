    $id = intval($_POST['id']);
    if ($id) {
        $stmt = $conn->prepare("DELETE FROM tarefas WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php');
        exit;
    } else {
        die('ID inválido.');
    }
}
?>
<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    if ($id) {
        $stmt = $conn->prepare("DELETE FROM tarefas WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php');
        exit;
    } else {
        die('ID inválido.');
    }
}
?>