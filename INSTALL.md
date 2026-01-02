# Not Defteri - Kurulum Rehberi

## Hızlı Başlangıç

### 1. Veritabanı Kurulumu

MySQL'de veritabanını oluşturun:

```bash
mysql -u root -p < database.sql
```

Veya MySQL komut satırından:

```sql
source database.sql;
```

### 2. Yapılandırma

`config.php` dosyasını düzenleyin ve veritabanı bilgilerinizi girin:

```php
define('DB_HOST', 'localhost');      // Veritabanı sunucusu
define('DB_USER', 'root');            // Kullanıcı adı
define('DB_PASS', 'şifreniz');        // Şifre
define('DB_NAME', 'notdefteri');      // Veritabanı adı
```

### 3. Web Sunucusu Yapılandırması

#### Apache (XAMPP, WAMP, vb.)

1. Proje klasörünü `htdocs` dizinine kopyalayın
2. Tarayıcıda `http://localhost/notdefteriPHP/` adresine gidin

#### Nginx

nginx.conf dosyanıza şu konfigürasyonu ekleyin:

```nginx
server {
    listen 80;
    server_name localhost;
    root /var/www/html/notdefteriPHP;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

#### PHP Geliştirme Sunucusu (Test için)

```bash
cd /path/to/notdefteriPHP
php -S localhost:8000
```

Tarayıcıda `http://localhost:8000` adresine gidin

### 4. İlk Kullanım

1. Ana sayfayı açın
2. "Yeni Not Ekle" butonuna tıklayın
3. İlk notunuzu oluşturun
4. Notlarınızı yönetin, arşivleyin veya silin

## Sorun Giderme

### Veritabanı Bağlantı Hatası

- MySQL'in çalıştığından emin olun
- `config.php` dosyasındaki bilgilerin doğru olduğunu kontrol edin
- Kullanıcının veritabanına erişim izni olduğunu doğrulayın

### Sayfa Görüntülenemedi

- PHP'nin yüklü ve çalışır durumda olduğundan emin olun
- Web sunucusunun doğru yapılandırıldığını kontrol edin
- Dosya izinlerinin uygun olduğunu doğrulayın

### Karakterler Hatalı Görünüyor

- Veritabanının UTF-8 karakter seti kullandığından emin olun
- `config.php` dosyasında `utf8mb4` kullanıldığını kontrol edin

## Güvenlik Önerileri

1. Veritabanı şifresini güçlü tutun
2. `config.php` dosyasını web kök dizininin dışında tutmayı düşünün
3. Üretim ortamında PHP hata mesajlarını kapatın
4. HTTPS kullanın
5. Düzenli yedekleme yapın

## Geliştirme

Proje üzerinde geliştirme yapmak için:

1. Yeni özellikler ekleyin
2. CSS'i özelleştirin
3. Kullanıcı kimlik doğrulaması ekleyin
4. Etiket sistemi ekleyin
5. Arama özelliği ekleyin
