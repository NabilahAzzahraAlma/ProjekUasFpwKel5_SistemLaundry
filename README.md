### 🧺 ProjekUasFpwKel5_SistemLaundry

Sistem Laundry KangCuciExpress adalah proyek Ujian Akhir Semester mata kuliah Framework Pemrograman Web yang dikembangkan oleh Kelompok 5 Informatika Universitas Singaperbangsa Karawang. Proyek ini bertujuan untuk membangun sistem informasi laundry berbasis web yang mendigitalisasi proses pemesanan, pelacakan status cucian, pembayaran digital lewat statis, dan pengelolaan operasional harian.

#### 🎯 Fitur Utama:

- Pemesanan layanan laundry online (kiloan, setrika, sepatu, dll)
- Pelacakan status cucian real-time
- Pembayaran digital terintegrasi (QRIS, VA, tunai)
- Dashboard admin untuk laporan harian dan manajemen layanan
- Fitur driver untuk rute pickup dan pengantaran
- Modul komplain pelanggan langsung dari website

#### 🛠️ Teknologi:

- Laravel Framework (Blade, Controller, Model, Migration)
- Database relasional dengan ERD terstruktur
- UI/UX wireframe responsif untuk pelanggan, admin, dan driver

#### 👥 Tim Pengembang:

- M.Fadli
- N.A Alma
- Marsya T.N
- Raffi N.F

lakukan
composer install
npm install
composer require maatwebsite/excel
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
