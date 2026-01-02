<?php
require_once 'config.php';

$conn = getDBConnection();

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $baslik = trim($_POST['baslik'] ?? '');
    $icerik = trim($_POST['icerik'] ?? '');
    
    if (empty($baslik)) {
        $error = 'Başlık alanı boş bırakılamaz.';
    } elseif (empty($icerik)) {
        $error = 'İçerik alanı boş bırakılamaz.';
    } else {
        $stmt = $conn->prepare("INSERT INTO notlar (baslik, icerik) VALUES (?, ?)");
        $stmt->bind_param("ss", $baslik, $icerik);
        
        if ($stmt->execute()) {
            $success = true;
            header("Location: index.php");
            exit;
        } else {
            $error = 'Not eklenirken bir hata oluştu.';
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
    <title>Yeni Not Ekle - Not Defteri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📔 Not Defteri</h1>
    </header>
    
    <div class="container">
        <div class="nav-buttons">
            <a href="index.php" class="btn btn-secondary">⬅️ Geri Dön</a>
        </div>
        
        <div class="note-detail">
            <h2>➕ Yeni Not Ekle</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    ⚠️ <?php echo h($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="baslik">Başlık:</label>
                    <input type="text" id="baslik" name="baslik" 
                           value="<?php echo h($_POST['baslik'] ?? ''); ?>" 
                           required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="icerik">İçerik:</label>
                    <textarea id="icerik" name="icerik" required><?php echo h($_POST['icerik'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">💾 Kaydet</button>
                    <a href="index.php" class="btn btn-secondary">❌ İptal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
