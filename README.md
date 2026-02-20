# Backend Laravel Project

## Struktur Database

struktur database:

### Tabel `tenants`

| Kolom      | Tipe      | Keterangan            |
| ---------- | --------- | --------------------- |
| id         | bigint    | Primary Key           |
| name       | string    | Nama tenant           |
| created_at | timestamp | Waktu dibuat          |
| updated_at | timestamp | Waktu update terakhir |

### Tabel `roles`

| Kolom      | Tipe      | Keterangan              |
| ---------- | --------- | ----------------------- |
| id         | bigint    | Primary Key             |
| name       | string    | Nama role (Owner/Staff) |
| created_at | timestamp | Waktu dibuat            |
| updated_at | timestamp | Waktu update terakhir   |

### Tabel `users`

| Kolom             | Tipe      | Keterangan                        |
| ----------------- | --------- | --------------------------------- |
| id                | bigint    | Primary Key                       |
| tenant_id         | bigint    | Foreign Key ke tabel tenants      |
| role_id           | bigint    | Foreign Key ke tabel roles        |
| name              | string    | Nama pengguna                     |
| email             | string    | Email pengguna, unik              |
| email_verified_at | timestamp | Waktu verifikasi email (nullable) |
| password          | string    | Password (hashed)                 |
| remember_token    | string    | Token remember me                 |
| created_at        | timestamp | Waktu dibuat                      |
| updated_at        | timestamp | Waktu update terakhir             |

### Tabel `products`

| Kolom      | Tipe      | Keterangan                   |
| ---------- | --------- | ---------------------------- |
| id         | bigint    | Primary Key                  |
| tenant_id  | bigint    | Foreign Key ke tabel tenants |
| name       | string    | Nama produk                  |
| price      | decimal   | Harga produk (14,2)          |
| deleted_at | timestamp | Waktu soft delete (nullable) |
| created_at | timestamp | Waktu dibuat                 |
| updated_at | timestamp | Waktu update terakhir        |

### Tabel `transactions`

| Kolom      | Tipe      | Keterangan                   |
| ---------- | --------- | ---------------------------- |
| id         | bigint    | Primary Key                  |
| tenant_id  | bigint    | Foreign Key ke tabel tenants |
| user_id    | bigint    | Foreign Key ke tabel users   |
| total      | decimal   | Total transaksi (14,2)       |
| created_at | timestamp | Waktu dibuat                 |
| updated_at | timestamp | Waktu update terakhir        |

### Tabel `transaction_items`

| Kolom                | Tipe      | Keterangan                             |
| -------------------- | --------- | -------------------------------------- |
| id                   | bigint    | Primary Key                            |
| transaction_id       | bigint    | Foreign Key ke tabel transactions      |
| product_id           | bigint    | Foreign Key ke tabel products          |
| qty                  | integer   | Jumlah produk                          |
| price_at_transaction | decimal   | Harga produk saat transaksi            |
| subtotal             | decimal   | Subtotal = qty \* price_at_transaction |
| created_at           | timestamp | Waktu dibuat                           |
| updated_at           | timestamp | Waktu update terakhir                  |

## Akun Login Demo

| Role   | Email                       | Password |
| ------ | --------------------------- | -------- |
| Owner1 | owner_abadinanjaya@test.com | password |
| Owner2 | owner_majumundur@test.com   | password |
| Staff1 | staff_majujterus@test.com   | password |
| Staff2 | staff_suksesjaya@tst.com    | password |

---

## Cara Menjalankan Project

1. Clone repository

```bash
git clone <repo-url>
cd mini-erp-test-case
```

2. Install dependencies

```bash
composer install
```

3. Copy `.env.example` menjadi `.env` dan sesuaikan konfigurasi database

```bash
cp .env.example .env
```

4. Migrasi dan seeding database

```bash
php artisan migrate --seed
```

5. Jalankan server

```bash
php artisan serve
```
