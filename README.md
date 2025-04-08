# Laravel Blog API

Bu proje, Laravel 10.48 ile geliştirilmiş bir Blog API'sidir. Kullanıcıların post paylaşabileceği, güncelleyebileceği, silebileceği ve resim ekleyebileceği bir API'yi içerir. API'de JWT (JSON Web Token) ile kullanıcı doğrulama ve yetkilendirme işlemleri yapılmaktadır.

## Kullanılan Teknolojiler

- **Laravel 10.48**: PHP framework'ü, MVC yapısı, API geliştirme ve ORM (Eloquent) veritabanı yönetimi için kullanıldı.
- **MySQL**: Veritabanı yönetimi için kullanıldı.
- **Postman**: API testleri için kullanıldı.
- **PHP 8.2**: Uygulama sunucu tarafında kullanılan PHP sürümü.
- **JWT Token**: Kullanıcı doğrulama ve yetkilendirme işlemleri için kullanıldı.

## Özellikler

- **Kullanıcı Yönetimi**:
  - Kullanıcılar kayıt olabilir, giriş yapabilir ve JWT token alabilir.
  - Kullanıcılar sadece kendi hesaplarını silebilir ve güncelleyebilirler.
  - Kullanıcılar yalnızca kendi oluşturdukları postları silebilir ve güncelleyebilirler.

- **Post Yönetimi**:
  - Kullanıcılar, kendi hesaplarında post oluşturabilir, güncelleyebilir ve silebilir.
  - Postlara bir veya birden fazla resim eklenebilir.

- **JWT Doğrulama**:
  - Kullanıcılar API'yi kullanabilmek için JWT token kullanarak doğrulama yapmalıdır.
  - Her API isteği için geçerli bir token gereklidir.

## API Rotaları

### Kullanıcılar

#### 1. Kullanıcı Kaydı (Register)

**POST** `/api/register`

- `name`: Kullanıcı adı (string)
- `email`: Kullanıcı e-posta (string)
- `password`: Kullanıcı şifresi (string)

Cevap:  
- **Başarı**: `201 Created` ve `user` verisi
- **Hata**: `400 Bad Request` (Geçersiz veri)

#### 2. Kullanıcı Girişi (Login)

**POST** `/api/login`

- `email`: Kullanıcı e-posta (string)
- `password`: Kullanıcı şifresi (string)

Cevap:  
- **Başarı**: `200 OK` ve `token` verisi (JWT)
- **Hata**: `401 Unauthorized` (Yanlış e-posta veya şifre)

#### 3. Kullanıcı Bilgilerini Güncelleme

**PUT** `/api/user/{id}`

- `name`: Kullanıcı adı (string) 
- `email`: Kullanıcı e-posta (string)

Cevap:  
- **Başarı**: `200 OK` ve `user` verisi
- **Hata**: `404 Not Found` (Kullanıcı bulunamadı)

#### 4. Kullanıcı Silme

**DELETE** `/api/user/{id}`

Cevap:  
- **Başarı**: `200 OK` ve `message`
- **Hata**: `404 Not Found` (Kullanıcı bulunamadı)

### Postlar

#### 1. Tüm Postları Görüntüleme

**GET** `/api/posts`

Cevap:  
- **Başarı**: `200 OK` ve `posts` listesi
- **Hata**: `404 Not Found`

#### 2. Post Oluşturma

**POST** `/api/posts`

- `title`: Post başlığı (string)
- `content`: Post içeriği (string)
- `images`: Posta ait resimlerin yolu (array)

Cevap:  
- **Başarı**: `201 Created` ve `post` verisi
- **Hata**: `400 Bad Request`

#### 3. Post Güncelleme

**PUT** `/api/posts/{id}`

- `title`: Post başlığı (string)
- `content`: Post içeriği (string)
- `images`: Posta ait resimlerin yolu (array)

Cevap:  
- **Başarı**: `200 OK` ve `post` verisi
- **Hata**: `404 Not Found` (Post bulunamadı)

#### 4. Post Silme

**DELETE** `/api/posts/{id}`

Cevap:  
- **Başarı**: `200 OK` ve `message`
- **Hata**: `404 Not Found` (Post bulunamadı)

## Kurulum

### Gereksinimler

- PHP 8.2 veya üstü
- Composer
- Laravel 10.48
- MySQL veya diğer veritabanları
- Postman (API testleri için)

### Kurulum Adımları

1. Projeyi klonlayın:

   git clone https://github.com/evcne/BlogRestAPI.git
2.cd BlogRestAPI
3.composer install
4.cp .env.example .env
5.Veritabanı ayarlarını .env dosyasına göre yapılandırın.
6.php artisan migrate
7.php artisan jwt:secret
8.php artisan serve
Uygulamanız http://127.0.0.1:8000 adresinde çalışmaya başlayacaktır.

API Testleri
Postman kullanarak API'nizi test edebilirsiniz. Projede geliştirdiğiniz API'leri test etmek için Postman'de gerekli istekleri yapabilirsiniz.

Error Handling
Bu proje, hata mesajlarını detaylı bir şekilde ele alır ve uygun HTTP status kodlarını döndürür. Hatalar için 400, 404, 500 gibi kodlar döndürülür ve her hata ile birlikte açıklayıcı bir mesaj gönderilir.

License
Bu proje MIT lisansı altında lisanslanmıştır. Daha fazla bilgi için LICENSE dosyasına bakın.

### Açıklamalar:

1. **Proje Özeti**: Laravel kullanarak geliştirilen bir API'nin temel özelliklerini tanımlar.
2. **Kullanılan Teknolojiler**: Laravel, MySQL, PHP, JWT ve Postman gibi kullanılan tüm teknolojileri belirtir.
3. **API Rotaları**: Kullanıcılar ve postlar için temel CRUD işlemleri hakkında bilgi verir.
4. **Kurulum Adımları**: Projeyi kendi bilgisayarınızda çalıştırabilmek için gerekli adımları listeler.
5. **Error Handling**: Hata yönetiminin nasıl çalıştığını belirtir.

Bu README dosyasını, GitHub reposuna yükledikten sonra projenizin kullanımını ve yapısını daha iyi açıklamış olursunuz.

