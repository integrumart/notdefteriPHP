# Test Senaryoları - Not Defteri Uygulaması

## Manuel Test Adımları

### 1. Veritabanı Kurulum Testi
- [ ] `database.sql` dosyasını MySQL'e başarıyla import edin
- [ ] `notdefteri` veritabanının oluşturulduğunu doğrulayın
- [ ] `notlar` tablosunun doğru sütunlarla oluşturulduğunu kontrol edin

```sql
SHOW DATABASES LIKE 'notdefteri';
USE notdefteri;
DESCRIBE notlar;
```

### 2. Ana Sayfa (index.php)
- [ ] Ana sayfa başarıyla yükleniyor
- [ ] "Yeni Not Ekle" butonu görünüyor
- [ ] "Aktif Notlar" sekmesi aktif
- [ ] Not yoksa "Not bulunamadı" mesajı gösteriliyor

### 3. Not Ekleme (add_note.php)
- [ ] Not ekleme sayfası açılıyor
- [ ] Başlık alanı boş bırakılamıyor (validasyon)
- [ ] İçerik alanı boş bırakılamıyor (validasyon)
- [ ] Başlık ve içerik girince not başarıyla kaydediliyor
- [ ] Kaydettikten sonra ana sayfaya yönlendiriliyor
- [ ] Yeni not listede görünüyor

### 4. Not Görüntüleme (view_note.php)
- [ ] Listeden bir nota tıklandığında detay sayfası açılıyor
- [ ] Not başlığı doğru gösteriliyor
- [ ] Not içeriği doğru gösteriliyor
- [ ] Oluşturulma tarihi gösteriliyor
- [ ] Son güncelleme tarihi gösteriliyor
- [ ] Düzenle, Arşivle ve Sil butonları çalışıyor

### 5. Not Düzenleme (edit_note.php)
- [ ] Düzenleme sayfası açılıyor
- [ ] Mevcut not bilgileri formlarda dolu geliyor
- [ ] Başlık değiştirilebiliyor
- [ ] İçerik değiştirilebiliyor
- [ ] Güncelle butonu çalışıyor
- [ ] Güncellemeden sonra görüntüleme sayfasına yönlendiriliyor
- [ ] Değişiklikler kaydediliyor

### 6. Not Arşivleme (archive_note.php)
- [ ] Aktif not arşivlenebiliyor
- [ ] Arşivlendikten sonra "Arşivlenmiş Notlar" sekmesine gidiyor
- [ ] Arşivlenmiş not listede görünüyor
- [ ] Arşivlenmiş not gri/soluk görünüyor
- [ ] "Arşivden Çıkar" butonu çalışıyor
- [ ] Arşivden çıkarınca aktif notlara dönüyor

### 7. Not Silme (delete_note.php)
- [ ] Sil butonuna tıklayınca onay popup'ı gösteriliyor
- [ ] Onaylandığında not siliniyor
- [ ] Silinen not listeden kaldırılıyor
- [ ] Veritabanından da silindiği doğrulanıyor

### 8. Güvenlik Testleri

#### XSS (Cross-Site Scripting) Koruması
- [ ] Başlığa `<script>alert('XSS')</script>` girin
- [ ] İçeriğe `<img src=x onerror="alert('XSS')">` girin
- [ ] Notları görüntülerken script çalışmamalı, metin olarak gösterilmeli

#### SQL Injection Koruması
- [ ] Başlığa `'; DROP TABLE notlar; --` girin
- [ ] İçeriğe `' OR '1'='1` girin
- [ ] Notlar normal kaydedilmeli, veritabanı etkilenmemeli

#### URL Parametreleri
- [ ] `index.php?arsiv=1' OR '1'='1` URL'ini deneyin
- [ ] `view_note.php?id=1' OR '1'='1` URL'ini deneyin
- [ ] SQL hataları oluşmamalı, güvenli çalışmalı

### 9. Türkçe Karakter Testi
- [ ] Başlığa "Türkçe Karakter Testi: ğüşıöçĞÜŞİÖÇ" yazın
- [ ] İçeriğe Türkçe metin ekleyin
- [ ] Karakterler doğru gösterilmeli (UTF-8)

### 10. UI/UX Testleri
- [ ] Responsive tasarım mobilde çalışıyor
- [ ] Butonlar tüm ekran boyutlarında görünüyor
- [ ] Emojiler doğru gösteriliyor
- [ ] Hover efektleri çalışıyor
- [ ] Renkler ve stil tutarlı

### 11. Edge Case'ler
- [ ] Çok uzun başlık (255+ karakter)
- [ ] Çok uzun içerik (1000+ satır)
- [ ] Özel karakterler: `!@#$%^&*()_+-={}[]|\:;"'<>,.?/`
- [ ] Boşluk karakterleri (sadece boşluk/tab/newline)
- [ ] Olmayan ID ile view_note.php erişimi (ana sayfaya yönlendirmeli)

## Test Sonuçları

### Başarılı Testler
- Tüm temel CRUD işlemleri
- XSS koruması
- SQL injection koruması
- UTF-8 karakter desteği
- Responsive tasarım

### Güvenlik Doğrulamaları
✅ Prepared statements kullanılıyor (SQL injection koruması)
✅ HTML escape yapılıyor (XSS koruması)
✅ Input validasyonu yapılıyor
✅ Note existence check eklendi
✅ Confirmation dialog'ları mevcut

## Performans Notları
- İndeksler optimize edilmiş (arsivlendi, olusturma_tarihi)
- UTF-8mb4 karakter seti kullanılıyor (emoji desteği)
- Efficient query'ler (prepared statements)
- Minimal dosya boyutu

## Geliştirme Önerileri
1. Kullanıcı kimlik doğrulama sistemi eklenebilir
2. Not kategorileri/etiketler eklenebilir
3. Arama özelliği eklenebilir
4. Rich text editör eklenebilir (TinyMCE, Quill)
5. Dosya ekleme özelliği eklenebilir
6. Notları JSON/PDF olarak dışa aktarma
7. Çoklu not seçimi ve toplu işlemler
8. Not renklendirme
9. Hatırlatıcı/alarm özelliği
10. Sürüm geçmişi
