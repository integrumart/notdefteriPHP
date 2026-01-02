<?php
require_once 'config.php';

$conn = getDBConnection();

// Sekme seçimi (aktif veya arşivlenmiş notlar)
$arsiv_goster = isset($_GET['arsiv']) && $_GET['arsiv'] == '1';
$arsivlendi = $arsiv_goster ? 1 : 0;

// Notları getir (prepared statement ile)
$stmt = $conn->prepare("SELECT * FROM notlar WHERE arsivlendi = ? ORDER BY guncelleme_tarihi DESC");
$stmt->bind_param("i", $arsivlendi);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Defteri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📔 Not Defteri</h1>
    </header>
    
    <div class="container">
        <div class="nav-buttons">
            <a href="add_note.php" class="btn btn-success">➕ Yeni Not Ekle</a>
        </div>
        
        <div class="tabs">
            <a href="index.php" class="tab <?php echo !$arsiv_goster ? 'active' : ''; ?>">
                Aktif Notlar
            </a>
            <a href="index.php?arsiv=1" class="tab <?php echo $arsiv_goster ? 'active' : ''; ?>">
                Arşivlenmiş Notlar
            </a>
        </div>
        
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="notes-grid">
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="note-card <?php echo $row['arsivlendi'] ? 'archived' : ''; ?>">
                        <h3><?php echo h($row['baslik']); ?></h3>
                        <div class="note-content">
                            <?php 
                            $preview = substr($row['icerik'], 0, 150);
                            echo h($preview);
                            if (strlen($row['icerik']) > 150) echo '...';
                            ?>
                        </div>
                        <div class="note-meta">
                            📅 <?php echo date('d.m.Y H:i', strtotime($row['olusturma_tarihi'])); ?>
                            <?php if ($row['guncelleme_tarihi'] != $row['olusturma_tarihi']): ?>
                                <br>🔄 <?php echo date('d.m.Y H:i', strtotime($row['guncelleme_tarihi'])); ?>
                            <?php endif; ?>
                        </div>
                        <div class="note-actions">
                            <a href="view_note.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-small">👁️ Görüntüle</a>
                            <a href="edit_note.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-small">✏️ Düzenle</a>
                            
                            <?php if ($row['arsivlendi']): ?>
                                <a href="archive_note.php?id=<?php echo $row['id']; ?>&unarchive=1" 
                                   class="btn btn-success btn-small"
                                   onclick="return confirm('Bu notu aktif notlara geri döndürmek istiyor musunuz?');">
                                    📤 Arşivden Çıkar
                                </a>
                            <?php else: ?>
                                <a href="archive_note.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-secondary btn-small"
                                   onclick="return confirm('Bu notu arşivlemek istiyor musunuz?');">
                                    📥 Arşivle
                                </a>
                            <?php endif; ?>
                            
                            <a href="delete_note.php?id=<?php echo $row['id']; ?>" 
                               class="btn btn-danger btn-small"
                               onclick="return confirm('Bu notu kalıcı olarak silmek istiyor musunuz?');">
                                🗑️ Sil
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h3>📭 Not bulunamadı</h3>
                <p><?php echo $arsiv_goster ? 'Arşivlenmiş notunuz bulunmuyor.' : 'Henüz hiç notunuz yok.'; ?></p>
                <?php if (!$arsiv_goster): ?>
                    <a href="add_note.php" class="btn btn-success">➕ İlk Notunuzu Ekleyin</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
