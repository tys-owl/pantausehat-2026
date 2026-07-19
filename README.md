# Capstone Project - HealthSync

![Laravel](https://img.shields.io/badge/LARAVEL-12-red?style=for-the-badge)
![Filament](https://img.shields.io/badge/FILAMENT-V3-orange?style=for-the-badge)
![Docker](https://img.shields.io/badge/DOCKER-ENABLED-blue?style=for-the-badge)
![MariaDB](https://img.shields.io/badge/MARIADB-10.11-brightgreen?style=for-the-badge)

Repositori ini dibuat untuk memenuhi tugas **Capstone Project** Program Studi Sistem Informasi tahun 2026. Proyek ini menampilkan **HealthSync**, aplikasi pemantau kesehatan harian berbasis web yang membantu pengguna memantau kebutuhan hidrasi dan kualitas tidur secara personal, berdasarkan berat badan, usia, dan tingkat aktivitas.

🌐 **Live Demo:** [healthsync.tyass.my.id](https://healthsync.tyass.my.id)

## 📷 Tampilan Web HealthSync 

### Halaman Depan & Informasi
| Landing Page | About Us |
| :---: | :---: |
| <img src="img/landing_page.png" width="400"> | <img src="img/about.png" width="400"> |

### Akses & Dashboard Pengguna
| Register | Login | Dashboard Utama |
| :---: | :---: | :---: |
| <img src="img/regis.png" width="250"> | <img src="img/login.png" width="250"> | <img src="img/dasboar.png" width="250"> |

### Fitur Kalkulator & Laporan
| Kalkulator Air | Kalkulator Tidur | Laporan Mingguan |
| :---: | :---: | :---: |
| <img src="img/kalkulator_air.png" width="250"> | <img src="img/kalkulator_tidur.png" width="250"> | <img src="img/laporan_mingguan.png" width="250"> |

### Analisis & Artikel Kesehatan
| Grafik Kesehatan | Riwayat Log | Daftar Artikel | Detail Artikel |
| :---: | :---: | :---: | :---: |
| <img src="img/grafik.png" width="180"> | <img src="img/riwayat.png" width="180"> | <img src="img/daftar_artikel.png" width="180"> | <img src="img/tampilan_artikel.png" width="180"> |

### Filament Admin Panel
| Dashboard Admin | CRUD Artikel | Web Setting (About) |
| :---: | :---: | :---: |
| <img src="img/panel_admin.png" width="250"> | <img src="img/crud_artikel.png" width="250"> | <img src="img/web_setting_about.png" width="250"> |

## 🛠️ Fitur Utama
- **Hydration Tracker:** Kalkulasi kebutuhan air minum harian secara personal.
- **Sleep Quality Log:** Pencatatan dan evaluasi utang tidur harian.
- **Data Visualization:** Grafik riwayat & tren hidrasi/tidur (Chart.js).
- **Manajemen Artikel Kesehatan:** CRUD artikel (judul, isi, gambar, status publikasi) lewat panel admin.
- **Manajemen Informasi Website:** Pengaturan halaman About, visi-misi, dan logo sistem.
- **Role & Permission:** Manajemen hak akses pengguna berbasis role (Spatie Permission + Filament Shield).
- **REST API:** Endpoint API untuk integrasi data kesehatan.
- **Desain Responsif:** Tampilan menyesuaikan ukuran layar (HP, tablet, laptop).

## 🚀 Teknologi yang Digunakan
- **Frontend:** Blade Templating Engine, Livewire, Tailwind CSS
- **Backend:** PHP 8.3 (Laravel 12, Filament v3)
- **Database:** MariaDB 10.11
- **Deployment:** Docker Compose, Nginx (reverse proxy), VPS dengan hosting subdomain

## ⚙️ Instalasi Lokal

```bash
git clone https://github.com/tys-owl/pantausehat-2026.git healthsync
cd healthsync
cp src/.env.example src/.env
docker compose up -d --build
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate --seed
docker compose exec php php artisan storage:link
```

Akses lewat `http://localhost` (sesuaikan port di `docker-compose.yml` kalau perlu).

## 👤 Penulis
- **Nama:** Lailita Ayuninigtias
- **NIM:** 20240803102
- **Program Studi:** Sistem Informasi
