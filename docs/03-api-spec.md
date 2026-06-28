# API Specification

> Dokumentasikan setiap endpoint yang dikembangkan maupun yang dikonsumsi dari layanan eksternal.
> Salin dan ulangi blok di bawah untuk setiap endpoint tambahan.

---

## [Login User]

**Method:** `[ POST ]`

**URL:** `/api/v1/[login]`

**Deskripsi:** `[Melakukan autentikasi pengguna dan menghasilkan token akses.]`

**Autentikasi Diperlukan:** `[Tidak]`

**Sumber:** `[Internal System]`

**Request Headers:**

```
Content-Type: application/json
```

**Request Body:**

```json
{
  "email": "string",
  "password": "string"
}
```

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "token": "jwt_token",
  "user": { "id": 1, "name": "Farah Nada", "email": "farah@example.com" }
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "[Email atau password salah]"
}
```

---

## [Registrasi User]

**Method:** `POST`

**URL:** `/api/v1/register`

**Deskripsi:** Mendaftarkan akun pengguna baru.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**

```
Content-Type: application/json
```

**Request Body:** ``
{
"name": "string",
"email": "string",
"password": "string"
}

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Registrasi berhasil"
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Email sudah digunakan"
}
```

---

## [Create Lost Item Report]

**Method:** `POST`

**URL:** `/api/v1/lost-items`

**Deskripsi:** Menambahkan laporan barang hilang.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:** ``
{
"item_name": "string",
"category": "string",
"description": "string",
"location": "string",
"lost_date": "date"
}

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Laporan barang hilang berhasil dibuat"
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Data tidak lengkap"
}
```

---

## [Create Found Item Report]

**Method:** `POST`

**URL:** `/api/v1/found-items`

**Deskripsi:** Menambahkan laporan barang ditemukan.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:** ``
{
"item_name": "string",
"category": "string",
"description": "string",
"location": "string",
"lost_date": "date"
}

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Laporan barang hilang berhasil dibuat"
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Data tidak lengkap"
}
```

---

## [Get All Reports]

**Method:** `POST`

**URL:** `/api/v1/reports`

**Deskripsi:** Menampilkan seluruh laporan barang hilang dan ditemukan.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```
Authorization: Bearer <token>
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "item_name": "Dompet",
      "status": "Lost"
    }
  ]
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Data tidak ditemukan"
}
```
