<?php
require_once 'config.php';

$conn = getDBConnection();

$note_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$unarchive = isset($_GET['unarchive']) && $_GET['unarchive'] == '1';

if ($note_id > 0) {
    if ($unarchive) {
        // Arşivden çıkar (arsivlendi = 0)
        $stmt = $conn->prepare("UPDATE notlar SET arsivlendi = 0 WHERE id = ?");
    } else {
        // Arşivle (arsivlendi = 1)
        $stmt = $conn->prepare("UPDATE notlar SET arsivlendi = 1 WHERE id = ?");
    }
    
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

// İşlem tamamlandıktan sonra uygun sayfaya yönlendir
if ($unarchive) {
    header("Location: index.php");
} else {
    header("Location: index.php?arsiv=1");
}
exit;
?>
