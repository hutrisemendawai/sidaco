Aplikasi Manajemen Data Ikan Sidat
Selamat datang di Aplikasi Manajemen Data Ikan Sidat. Aplikasi web ini dibuat menggunakan Laravel 10 untuk membantu pengguna dan administrator dalam mencatat, mengelola, dan menganalisis data penangkapan ikan sidat secara efisien dan akurat.

Aplikasi ini dirancang untuk menjadi platform terpusat bagi para peneliti, nelayan, dan pemangku kepentingan untuk melacak berbagai metrik penting terkait populasi dan penangkapan sidat. Dengan fitur visualisasi data yang canggih dan manajemen data yang intuitif, aplikasi ini bertujuan untuk mendukung pengambilan keputusan yang lebih baik dalam pengelolaan sumber daya perikanan sidat.

Daftar Fitur
Manajemen Pengguna: Sistem otentikasi lengkap dengan dua level peran:

User: Dapat mengelola (membuat, melihat, mengedit, menghapus) data yang mereka masukkan sendiri.

Admin: Memiliki semua hak akses User, ditambah kemampuan untuk melihat dan mengelola data dari semua pengguna serta mengelola peran pengguna lain.

Dasbor Analitik Interaktif: Halaman utama setelah login yang menyajikan visualisasi data secara komprehensif.

Kartu Statistik Utama: Menampilkan ringkasan data kunci seperti total entri, total berat tangkapan tahun ini, dan jumlah nelayan unik, dengan animasi angka yang menarik.

6 Bagan Dinamis: Termasuk grafik garis untuk tren bulanan, diagram lingkaran untuk komposisi spesies, dan diagram batang untuk perbandingan data antar provinsi, nelayan, dan lainnya.

Filter Global: Semua bagan di dasbor dapat difilter secara bersamaan berdasarkan Tahun, Bulan, Provinsi, atau Spesies untuk analisis yang lebih mendalam.

Manajemen Data (CRUD): Fungsionalitas penuh untuk mengelola catatan data sidat.

Create: Formulir input data yang terstruktur dan mudah digunakan.

Read: Tampilan tabel yang jelas dengan paginasi untuk menangani volume data yang besar.

Update: Kemampuan untuk mengedit setiap entri data yang ada.

Delete: Opsi untuk menghapus data dengan konfirmasi untuk mencegah kehilangan data yang tidak disengaja.

Pencarian & Filter Lanjutan: Alat bantu yang kuat di halaman data untuk navigasi yang cepat.

Pencarian Teks: Cari data secara instan berdasarkan nama sungai, spesies, atau nama nelayan.

Filter Rentang Tanggal: Tampilkan data hanya dari periode waktu tertentu (misalnya, 1 Juni 2025 hingga 31 Juli 2025).

Ekspor ke Excel: Ekspor data yang telah difilter ke dalam format .xlsx dengan satu klik. Fitur ini sangat berguna untuk analisis offline, pembuatan laporan, atau berbagi data dengan pihak lain.

QR Code Unik: Setiap entri data secara otomatis menghasilkan QR Code.

Akses Cepat: Pindai kode dengan perangkat mobile untuk langsung membuka halaman detail publik tanpa perlu login.

Integrasi Fisik: QR Code dapat dicetak dan ditempel pada laporan fisik atau sampel untuk referensi silang yang mudah.

Avatar Otomatis: Sistem avatar yang cerdas dan tidak memerlukan unggah foto. Avatar pengguna dibuat secara otomatis menggunakan inisial dari nama depan dan nama belakang mereka, memberikan sentuhan personal pada antarmuka.

Antarmuka Responsif: Didesain dengan pendekatan mobile-first, aplikasi ini memberikan pengalaman pengguna yang konsisten dan optimal baik diakses melalui browser desktop, tablet, maupun smartphone.

Cara Menggunakan Aplikasi (Panduan Pengguna)
1. Registrasi & Login
Registrasi: Untuk memulai, setiap pengguna baru harus membuat akun. Klik tombol "Register" di halaman login. Isi semua informasi yang diperlukan. Pastikan kata sandi Anda minimal 8 karakter untuk keamanan. Nomor telepon harus sesuai dengan format Indonesia (diawali dengan 08). Setelah berhasil, Anda akan langsung masuk ke dasbor.

Login: Jika Anda sudah memiliki akun, masukkan email dan kata sandi Anda di halaman utama. Jika Anda lupa kata sandi, fungsionalitas pemulihan dapat ditambahkan di masa mendatang.

2. Dasbor
Dasbor adalah pusat kendali visual Anda. Halaman ini memberikan gambaran umum tentang data yang ada di sistem.

Statistik Utama: Di bagian atas, Anda akan melihat tiga kartu statistik yang memberikan informasi cepat. Angka-angka ini akan beranimasi saat halaman dimuat, memberikan kesan dinamis.

Bagan Interaktif: Enam bagan utama memberikan wawasan mendalam. Arahkan kursor ke bagian bagan untuk melihat detail lebih lanjut (misalnya, jumlah pasti pada diagram batang).

Filter Dasbor: Gunakan panel filter di bagian atas untuk menyaring data yang ditampilkan di semua bagan. Misalnya, memilih "Tahun: 2025" dan "Bulan: Juli" akan memperbarui semua bagan untuk hanya menampilkan data dari Juli 2025. Klik "Reset" untuk kembali ke tampilan semua data.

3. Halaman Data Sidat
Ini adalah halaman utama untuk manajemen data mentah.

Tabel Data: Data disajikan dalam format tabel yang bersih dan mudah dibaca. Jika data melebihi 15 entri, navigasi paginasi akan muncul di bagian bawah untuk berpindah antar halaman.

Pencarian: Ketik kata kunci di bilah pencarian (misalnya, "Musi", "Anguilla bicolor", atau "Budi Santoso") dan tekan Enter untuk memfilter tabel secara instan.

Filter Lanjutan: Klik "Advanced Filters" untuk membuka opsi filter berdasarkan rentang tanggal. Pilih tanggal mulai dan akhir, lalu klik "Apply".

Ekspor: Setelah Anda memfilter data sesuai keinginan, klik tombol "Export to Excel". File .xlsx yang diunduh hanya akan berisi data yang sedang Anda lihat di tabel.

QR Code: Klik pada gambar QR Code kecil di setiap baris untuk melihat versi yang lebih besar di jendela pop-up. Pindai kode ini dengan kamera ponsel Anda untuk membuka halaman detail.

Aksi:

Edit (Ikon Pensil): Membawa Anda ke formulir edit yang sudah terisi dengan data yang ada.

Delete (Ikon Tong Sampah): Akan memunculkan dialog konfirmasi. Data hanya akan dihapus secara permanen jika Anda mengonfirmasi tindakan tersebut.

4. Manajemen Pengguna (Khusus Admin)
Sebagai admin, Anda akan melihat tautan "User Management" di bilah navigasi utama.

Halaman ini menampilkan daftar semua pengguna terdaftar. Anda dapat melihat nama, email, dan peran mereka saat ini yang ditandai dengan lencana berwarna (misalnya, hijau untuk Admin, kuning untuk User).

Untuk mengubah peran, cukup pilih peran baru dari menu dropdown di samping nama pengguna dan klik "Save". Perubahan akan segera berlaku.

5. Manajemen Profil
Akses halaman profil Anda dengan mengklik nama Anda di pojok kanan atas dan memilih "Profile".

Update Profile Information: Di sini Anda dapat mengubah detail pribadi Anda. Perhatikan bahwa alamat email tidak dapat diubah karena berfungsi sebagai pengenal unik akun Anda.

Update Password: Untuk keamanan, Anda harus memasukkan kata sandi saat ini sebelum dapat mengatur kata sandi baru.

Delete Account: Ini adalah tindakan permanen. Sebuah dialog akan meminta Anda memasukkan kata sandi untuk mengonfirmasi penghapusan. Setelah dikonfirmasi, semua data Anda, termasuk catatan sidat yang telah Anda masukkan, akan dihapus selamanya.

Cara Deploy Aplikasi
Kebutuhan Server
PHP >= 8.1: Versi bahasa pemrograman yang digunakan Laravel.

Composer: Manajer dependensi untuk PHP, digunakan untuk menginstal paket-paket Laravel.

Node.js & NPM: Dibutuhkan untuk mengelola dan membangun aset frontend (CSS & JavaScript).

Database: MySQL atau MariaDB direkomendasikan.

Web Server: Nginx atau Apache untuk melayani aplikasi.

A. Instalasi di Lingkungan Lokal (Contoh: Laragon)
Proses ini dirancang agar cepat dan mudah untuk memulai pengembangan.

Clone Repository: Unduh kode sumber dari repositori Git.

git clone [URL_REPOSITORY_ANDA] sidat-app
cd sidat-app

Install Dependencies: Instal semua paket PHP dan JavaScript yang diperlukan.

composer install
npm install

Konfigurasi Lingkungan:

Salin file konfigurasi contoh. File .env adalah tempat Anda menyimpan semua kredensial dan pengaturan spesifik lingkungan.

copy .env.example .env

Buat kunci enkripsi unik untuk aplikasi Anda. Ini sangat penting untuk keamanan sesi dan data terenkripsi.

php artisan key:generate

Buka file .env dan sesuaikan pengaturan database agar cocok dengan konfigurasi Laragon Anda.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sidat_app
DB_USERNAME=root
DB_PASSWORD=

Migrasi Database:

Gunakan alat bantu database Laragon (HeidiSQL/phpMyAdmin) untuk membuat database baru dengan nama sidat_app.

Jalankan perintah migrasi untuk membuat struktur tabel di database Anda berdasarkan file migrasi di proyek.

php artisan migrate

Build Aset Frontend: Kompilasi file CSS dan JavaScript menjadi file tunggal yang siap digunakan di browser.

npm run build

Akses Aplikasi: Laragon secara otomatis membuat URL lokal yang mudah diingat. Cukup muat ulang Laragon dan akses http://sidat-app.test di browser Anda.

B. Deploy ke Server Produksi
Proses ini memerlukan perhatian lebih pada keamanan dan performa.

Clone & Install: Lakukan langkah 1 & 2 seperti di atas pada server produksi Anda (misalnya, di dalam direktori /var/www/).

Konfigurasi .env untuk Produksi:

Isi detail koneksi database produksi Anda.

Sangat Penting: Atur variabel berikut untuk menonaktifkan mode debug dan mengoptimalkan aplikasi untuk produksi.

APP_ENV=production
APP_DEBUG=false

Jalankan Migrasi & Buat Kunci:

php artisan key:generate
php artisan migrate --force

Flag --force diperlukan karena Laravel akan mendeteksi bahwa Anda berada di lingkungan produksi dan meminta konfirmasi.

Optimasi Aplikasi:
Perintah-perintah ini akan membuat file cache untuk konfigurasi, route, dan view, yang secara signifikan mengurangi waktu muat halaman. storage:link membuat tautan simbolis agar file yang diunggah di storage dapat diakses dari direktori public.

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

Konfigurasi Web Server (Contoh Nginx):

Arahkan document root dari domain Anda ke direktori public proyek, bukan direktori root. Ini adalah praktik keamanan penting untuk mencegah akses langsung ke file sensitif.

Contoh konfigurasi dasar Nginx:

server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/sidat-app/public; # Arahkan ke folder public

    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        # Sesuaikan dengan versi PHP-FPM Anda
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    }

    location ~ /\.ht {
        deny all; # Blokir akses ke file .htaccess
    }
}

Atur Hak Akses Folder:
Web server (biasanya pengguna www-data) memerlukan izin untuk menulis ke direktori storage (untuk log, cache, dll.) dan bootstrap/cache.

sudo chown -R $USER:www-data /var/www/sidat-app
sudo chown -R www-data:www-data /var/www/sidat-app/storage
sudo chown -R www-data:www-data /var/www/sidat-app/bootstrap/cache
sudo chmod -R 775 /var/www/sidat-app/storage
sudo chmod -R 775 /var/www/sidat-app/bootstrap/cache

Setelah semua langkah ini selesai dan DNS domain Anda telah diarahkan ke IP server, aplikasi Anda akan aktif dan dapat diakses secara publik.