<?php
require_once 'config.php';

$conn = getDBConnection();

$note_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Not bilgilerini getir
$stmt = $conn->prepare("SELECT * FROM notlar WHERE id = ?");
$stmt->bind_param("i", $note_id);
$stmt->execute();
$result = $stmt->get_result();
$note = $result->fetch_assoc();
$stmt->close();

if (!$note) {
    header("Location: index.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($note['baslik']); ?> - Not Defteri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📔 Not Defteri</h1>
    </header>
    
    <div class="container">
        <div class="nav-buttons">
            <a href="index.php" class="btn btn-secondary">⬅️ Ana Sayfa</a>
            <a href="edit_note.php?id=<?php echo $note['id']; ?>" class="btn btn-warning">✏️ Düzenle</a>
            
            <?php if ($note['arsivlendi']): ?>
                <a href="archive_note.php?id=<?php echo $note['id']; ?>&unarchive=1" 
                   class="btn btn-success"
                   onclick="return confirm('Bu notu aktif notlara geri döndürmek istiyor musunuz?');">
                    📤 Arşivden Çıkar
                </a>
            <?php else: ?>
                <a href="archive_note.php?id=<?php echo $note['id']; ?>" 
                   class="btn btn-secondary"
                   onclick="return confirm('Bu notu arşivlemek istiyor musunuz?');">
                    📥 Arşivle
                </a>
            <?php endif; ?>
            
            <a href="delete_note.php?id=<?php echo $note['id']; ?>" 
               class="btn btn-danger"
               onclick="return confirm('Bu notu kalıcı olarak silmek istiyor musunuz?');">
                🗑️ Sil
            </a>
        </div>
        
        <div class="note-detail">
            <?php if ($note['arsivlendi']): ?>
                <div class="alert alert-info">
                    📥 Bu not arşivlenmiştir.
                </div>
            <?php endif; ?>
            
            <h2><?php echo h($note['baslik']); ?></h2>
            
            <div class="note-meta">
                📅 Oluşturulma: <?php echo date('d.m.Y H:i', strtotime($note['olusturma_tarihi'])); ?>
                <br>
                🔄 Son Güncelleme: <?php echo date('d.m.Y H:i', strtotime($note['guncelleme_tarihi'])); ?>
            </div>
            
            <div class="note-content">
                <?php echo nl2br(h($note['icerik'])); ?>
            </div>
        </div>
    </div>
</body>
</html>
