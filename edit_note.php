<?php
require_once 'config.php';

$conn = getDBConnection();

$note_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
$success = false;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $baslik = trim($_POST['baslik'] ?? '');
    $icerik = trim($_POST['icerik'] ?? '');
    
    if (empty($baslik)) {
        $error = 'Başlık alanı boş bırakılamaz.';
    } elseif (empty($icerik)) {
        $error = 'İçerik alanı boş bırakılamaz.';
    } else {
        $stmt = $conn->prepare("UPDATE notlar SET baslik = ?, icerik = ? WHERE id = ?");
        $stmt->bind_param("ssi", $baslik, $icerik, $note_id);
        
        if ($stmt->execute()) {
            $success = true;
            header("Location: view_note.php?id=" . $note_id);
            exit;
        } else {
            $error = 'Not güncellenirken bir hata oluştu.';
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Düzenle - Not Defteri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📔 Not Defteri</h1>
    </header>
    
    <div class="container">
        <div class="nav-buttons">
            <a href="view_note.php?id=<?php echo $note_id; ?>" class="btn btn-secondary">⬅️ Geri Dön</a>
        </div>
        
        <div class="note-detail">
            <h2>✏️ Not Düzenle</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    ⚠️ <?php echo h($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="baslik">Başlık:</label>
                    <input type="text" id="baslik" name="baslik" 
                           value="<?php echo h($_POST['baslik'] ?? $note['baslik']); ?>" 
                           required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="icerik">İçerik:</label>
                    <textarea id="icerik" name="icerik" required><?php echo h($_POST['icerik'] ?? $note['icerik']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">💾 Güncelle</button>
                    <a href="view_note.php?id=<?php echo $note_id; ?>" class="btn btn-secondary">❌ İptal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
