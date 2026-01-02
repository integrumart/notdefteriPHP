<?php
require_once 'config.php';

$conn = getDBConnection();

$note_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($note_id > 0) {
    $stmt = $conn->prepare("DELETE FROM notlar WHERE id = ?");
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header("Location: index.php");
exit;
?>
