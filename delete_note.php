<?php
require_once 'config.php';

$conn = getDBConnection();

$note_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($note_id > 0) {
    // Önce notun var olup olmadığını kontrol et
    $stmt = $conn->prepare("SELECT id FROM notlar WHERE id = ?");
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Not varsa sil
        $stmt->close();
        $stmt = $conn->prepare("DELETE FROM notlar WHERE id = ?");
        $stmt->bind_param("i", $note_id);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();

header("Location: index.php");
exit;
?>
