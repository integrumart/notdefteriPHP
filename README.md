# notdefteriPHP
MySQL tabanlı basit not defteri uygulaması

## Özellikler

- ✏️ Not ekleme ve düzenleme
- 👁️ Not görüntüleme
- 📥 Not arşivleme
- 📤 Arşivden çıkarma
- 🗑️ Not silme
- 📋 Aktif ve arşivlenmiş notlar arasında geçiş
- 📱 Responsive tasarım

## Kurulum

### Gereksinimler

- PHP 7.0 veya üzeri
- MySQL 5.6 veya üzeri
- Web sunucusu (Apache, Nginx, vb.)

### Adımlar

1. Projeyi klonlayın veya indirin:
```bash
git clone https://github.com/integrumart/notdefteriPHP.git
cd notdefteriPHP
```

2. MySQL veritabanını oluşturun:
```bash
mysql -u root -p < database.sql
```

3. `config.php` dosyasındaki veritabanı ayarlarını düzenleyin:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Veritabanı şifreniz
define('DB_NAME', 'notdefteri');
```

4. Proje klasörünü web sunucunuzun root dizinine kopyalayın (örn: `/var/www/html/` veya `htdocs/`)

5. Tarayıcınızda `http://localhost/notdefteriPHP/` adresine gidin

## Kullanım

### Yeni Not Ekleme
1. Ana sayfada "Yeni Not Ekle" butonuna tıklayın
2. Not başlığı ve içeriğini girin
3. "Kaydet" butonuna tıklayın

### Not Görüntüleme
- Ana sayfada bir notun üzerine tıklayın veya "Görüntüle" butonunu kullanın

### Not Düzenleme
- Not görüntüleme sayfasında veya ana sayfada "Düzenle" butonuna tıklayın
- Değişiklikleri yapın ve "Güncelle" butonuna tıklayın

### Not Arşivleme
- Aktif bir notu arşivlemek için "Arşivle" butonuna tıklayın
- Arşivlenmiş notları görmek için "Arşivlenmiş Notlar" sekmesine tıklayın
- Arşivlenmiş bir notu geri döndürmek için "Arşivden Çıkar" butonuna tıklayın

### Not Silme
- Bir notu kalıcı olarak silmek için "Sil" butonuna tıklayın

## Veritabanı Yapısı

### notlar tablosu
- `id` - Otomatik artan benzersiz kimlik
- `baslik` - Not başlığı
- `icerik` - Not içeriği
- `olusturma_tarihi` - Oluşturulma tarihi
- `guncelleme_tarihi` - Son güncelleme tarihi
- `arsivlendi` - Arşiv durumu (0: aktif, 1: arşivlenmiş)

## Dosya Yapısı

```
notdefteriPHP/
├── config.php           # Veritabanı yapılandırması
├── database.sql         # Veritabanı şeması
├── index.php           # Ana sayfa (not listesi)
├── add_note.php        # Not ekleme sayfası
├── edit_note.php       # Not düzenleme sayfası
├── view_note.php       # Not görüntüleme sayfası
├── archive_note.php    # Not arşivleme işlemi
├── delete_note.php     # Not silme işlemi
├── style.css           # CSS stilleri
└── README.md           # Bu dosya
```

## Güvenlik

- SQL injection saldırılarına karşı prepared statements kullanılır
- XSS saldırılarına karşı HTML karakterleri encode edilir
- Kullanıcı girdileri sanitize edilir

## Lisans

MIT License - Detaylar için LICENSE dosyasına bakın.
