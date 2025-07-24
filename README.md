# Aplikasi Manajemen Data Ikan Sidat

Selamat datang di Aplikasi Manajemen Data Ikan Sidat. Aplikasi web ini dibangun dengan cermat menggunakan Laravel 10 untuk berfungsi sebagai sebuah platform terpusat yang kuat bagi para pengguna dan administrator. Tujuannya adalah untuk menyederhanakan proses pencatatan, pengelolaan, dan analisis data penangkapan ikan sidat, memastikan setiap data tercatat secara efisien dan akurat.

Aplikasi ini dirancang secara khusus untuk memenuhi kebutuhan berbagai pemangku kepentingan, termasuk lembaga penelitian, dinas perikanan pemerintah, dan komunitas nelayan lokal. Dengan menyediakan platform terpadu, aplikasi ini memfasilitasi kolaborasi dan standardisasi data di antara berbagai pihak. Fitur visualisasi data yang canggih dan alur manajemen data yang intuitif dirancang tidak hanya untuk mengumpulkan data, tetapi juga untuk mengubahnya menjadi wawasan yang dapat ditindaklanjuti. Pada akhirnya, aplikasi ini bertujuan untuk mendukung pengambilan keputusan berbasis data yang lebih baik, yang sangat krusial untuk pengelolaan sumber daya perikanan sidat yang berkelanjutan dan upaya konservasinya di masa depan.

---

## Daftar Fitur

* **Manajemen Pengguna:** Sistem otentikasi yang aman dan lengkap dengan dua level peran yang jelas untuk kontrol akses yang terperinci:
    * **User:** Peran standar yang memungkinkan pengguna (misalnya, nelayan atau pencatat data lapangan) untuk mengelola—membuat, melihat, mengedit, dan menghapus—data yang mereka masukkan sendiri. Setiap pengguna memiliki ruang kerja data yang terisolasi untuk memastikan privasi dan kepemilikan data.
    * **Admin:** Peran dengan hak akses tertinggi. Admin memiliki semua kemampuan seorang User, ditambah dengan akses penuh untuk melihat dan mengelola data dari *semua* pengguna. Ini penting untuk pengawasan, validasi data, dan analisis agregat. Selain itu, admin memiliki wewenang untuk mengelola peran pengguna lain, mempromosikan User menjadi Admin atau sebaliknya.

* **Dasbor Analitik Interaktif:** Halaman utama setelah login yang berfungsi sebagai pusat komando visual, menyajikan data dalam format yang mudah dicerna.
    * **Kartu Statistik Utama:** Tiga kartu di bagian atas memberikan ringkasan data kunci secara *real-time*, seperti total entri yang tercatat, total berat tangkapan dalam kilogram untuk tahun berjalan, dan jumlah nelayan unik yang telah menyumbangkan data. Angka-angka ini disajikan dengan animasi hitung yang menarik saat halaman dimuat.
    * **6 Bagan Dinamis:** Visualisasi data yang kaya untuk analisis mendalam, termasuk grafik garis untuk melacak tren tangkapan bulanan, diagram lingkaran (*doughnut chart*) untuk melihat komposisi spesies yang paling dominan, dan diagram batang untuk membandingkan jumlah data antar provinsi, produktivitas nelayan, dan lainnya.
    * **Filter Global:** Sebuah panel filter yang dapat diciutkan memungkinkan pengguna untuk menyaring data di seluruh dasbor secara bersamaan berdasarkan Tahun, Bulan, Provinsi, atau Spesies tertentu. Ini memungkinkan analisis yang sangat spesifik, misalnya, "tampilkan data untuk spesies *Anguilla marmorata* di Sumatera Selatan selama kuartal ketiga tahun 2025."

* **Manajemen Data (CRUD):** Fungsionalitas penuh untuk mengelola siklus hidup setiap catatan data sidat.
    * **Create:** Formulir input yang terstruktur dengan validasi data di setiap kolom untuk memastikan integritas dan konsistensi data yang dimasukkan.
    * **Read:** Tampilan tabel yang bersih dengan *header* yang tetap terlihat saat menggulir (*sticky header*) dan paginasi otomatis, memastikan penanganan data dalam volume besar tetap lancar dan tidak membebani peramban.
    * **Update:** Kemampuan untuk mengedit setiap entri data yang ada melalui formulir yang sudah terisi sebelumnya, meminimalkan kesalahan input ulang.
    * **Delete:** Opsi penghapusan yang aman dengan dialog konfirmasi SweetAlert untuk mencegah kehilangan data yang tidak disengaja.

* **Pencarian & Filter Lanjutan:** Alat bantu yang kuat di halaman data untuk navigasi yang cepat dan efisien.
    * **Pencarian Teks:** Bilah pencarian tunggal yang dapat mencari data secara instan di beberapa kolom kunci sekaligus, seperti nama sungai, spesies, atau nama nelayan.
    * **Filter Rentang Tanggal:** Pengguna dapat memilih tanggal mulai dan akhir dari kalender untuk menampilkan data hanya dari periode waktu tertentu, sangat berguna untuk laporan mingguan, bulanan, atau kuartalan.

* **Ekspor ke Excel:** Dengan satu klik, pengguna dapat mengekspor data yang telah difilter di tabel ke dalam format `.xlsx`. Fitur ini sangat penting untuk analisis data lebih lanjut di luar aplikasi, membuat laporan kustom, atau berbagi data dengan pemangku kepentingan yang tidak memiliki akses langsung ke sistem.

* **QR Code Unik:** Setiap entri data secara otomatis menghasilkan QR Code yang unik, menjembatani data digital dengan dunia fisik.
    * **Akses Cepat:** Pindai kode dengan kamera ponsel untuk membuka halaman detail publik yang menampilkan informasi kunci dari catatan tersebut. Halaman ini dapat diakses oleh siapa saja tanpa perlu login, ideal untuk berbagi informasi secara cepat.
    * **Integrasi Fisik:** Bayangkan sebuah skenario di mana QR Code dicetak dan ditempel pada wadah sampel di laboratorium atau pada laporan cetak. Siapa pun dapat memindainya untuk langsung mengakses catatan digital lengkapnya, menciptakan alur kerja yang mulus.

* **Avatar Otomatis:** Sistem avatar yang cerdas yang meningkatkan pengalaman pengguna tanpa memerlukan upaya tambahan dari pengguna. Avatar secara dinamis dibuat menggunakan inisial nama depan dan belakang pengguna, memberikan identitas visual yang jelas di seluruh aplikasi, terutama di menu navigasi dan tabel manajemen pengguna oleh admin.

* **Antarmuka Responsif:** Didesain dengan pendekatan *mobile-first* menggunakan Tailwind CSS, aplikasi ini memastikan bahwa semua fitur, mulai dari tabel data hingga bagan interaktif, berfungsi dan terlihat sempurna di berbagai perangkat, baik itu browser desktop layar lebar, tablet, maupun smartphone.

---

## Cara Menggunakan Aplikasi (Panduan Pengguna)

### 1. Registrasi & Login

* **Registrasi:** Untuk memulai, setiap pengguna baru harus membuat akun. Klik tombol **"Register"** di halaman login. Isi semua informasi yang diperlukan dengan cermat. Pastikan kata sandi Anda kuat (minimal 8 karakter). Nomor telepon harus sesuai dengan format Indonesia (diawali dengan `08`). Setelah berhasil, Anda akan secara otomatis masuk dan diarahkan ke dasbor utama.
* **Login:** Jika Anda sudah memiliki akun, cukup masukkan email dan kata sandi Anda di halaman utama. Fungsionalitas "Lupa Kata Sandi" dapat ditambahkan di masa mendatang untuk memungkinkan pengguna mengatur ulang kata sandi mereka melalui email.

### 2. Dasbor

Dasbor adalah pusat kendali visual Anda. Halaman ini dirancang untuk memberikan gambaran umum tingkat tinggi dari data yang terkumpul di sistem.

* **Statistik Utama:** Di bagian atas, Anda akan melihat tiga kartu statistik yang menyoroti metrik paling penting. Angka-angka ini akan beranimasi saat halaman dimuat, memberikan umpan balik visual yang memuaskan.
* **Bagan Interaktif:** Enam bagan utama memberikan wawasan mendalam. Arahkan kursor Anda ke elemen bagan (seperti batang atau irisan pai) untuk melihat *tooltip* dengan informasi detail, misalnya, jumlah pasti pada diagram batang atau persentase pada diagram lingkaran.
* **Filter Dasbor:** Gunakan panel filter yang dapat diciutkan di bagian atas untuk menyaring data. Misalnya, jika Anda ingin menganalisis data penangkapan di "SUMATERA SELATAN" selama tahun "2025", cukup pilih opsi tersebut dan klik "Filter". Semua enam bagan akan diperbarui secara instan untuk mencerminkan kueri Anda. Klik **"Reset"** untuk menghapus semua filter dan kembali ke tampilan data global.

### 3. Halaman Data Sidat

Ini adalah halaman di mana Anda dapat berinteraksi langsung dengan data mentah.

* **Tabel Data:** Data disajikan dalam format tabel yang bersih. Jika jumlah data melebihi 15 entri per halaman, tautan paginasi (`1, 2, 3, ...`) akan muncul di bagian bawah, memungkinkan Anda untuk menavigasi ke halaman lain dengan mudah.
* **Pencarian:** Ketik kata kunci di bilah pencarian dan tekan Enter. Tabel akan diperbarui secara dinamis untuk menampilkan hanya baris yang cocok dengan kueri Anda di kolom-kolom yang relevan.
* **Filter Lanjutan:** Klik "Advanced Filters" untuk membuka opsi filter berdasarkan rentang tanggal. Ini memungkinkan Anda untuk mengisolasi data dari periode tertentu, yang sangat berguna untuk analisis tren.
* **Ekspor:** Setelah Anda memfilter data sesuai keinginan, klik tombol **"Export to Excel"**. File `.xlsx` yang diunduh akan berisi data yang sama persis dengan yang Anda lihat di tabel, termasuk urutan dan filternya.
* **QR Code:** Klik pada gambar QR Code kecil di setiap baris untuk melihat versi yang lebih besar di jendela pop-up, membuatnya lebih mudah untuk dipindai.
* **Aksi:**
    * **Edit (Ikon Pensil):** Mengarahkan Anda ke formulir edit yang sudah terisi dengan data dari baris tersebut, memungkinkan Anda untuk memperbaiki kesalahan atau memperbarui informasi dengan cepat.
    * **Delete (Ikon Tong Sampah):** Memunculkan dialog konfirmasi yang modern (menggunakan SweetAlert) untuk memastikan Anda tidak sengaja menghapus data. Data hanya akan dihapus secara permanen jika Anda mengonfirmasi tindakan tersebut.

### 4. Manajemen Pengguna (Khusus Admin)

* Sebagai admin, Anda akan melihat tautan **"User Management"** di bilah navigasi utama.
* Halaman ini menampilkan daftar semua pengguna. Peran mereka saat ini ditandai dengan lencana berwarna untuk identifikasi cepat.
* Untuk mengubah peran, cukup pilih peran baru dari menu dropdown dan klik **"Save"**. Halaman akan dimuat ulang dengan pesan sukses, dan peran pengguna akan segera diperbarui di seluruh sistem.

### 5. Manajemen Profil

* Akses halaman profil Anda dengan mengklik nama dan avatar Anda di pojok kanan atas, lalu pilih **"Profile"**.
* **Update Profile Information:** Di sini Anda dapat mengubah detail pribadi Anda. Perhatikan bahwa alamat email tidak dapat diubah karena berfungsi sebagai pengenal unik akun Anda.
* **Update Password:** Untuk keamanan, Anda harus memasukkan kata sandi saat ini dengan benar sebelum dapat mengatur kata sandi baru.
* **Delete Account:** Ini adalah tindakan yang tidak dapat diurungkan. Sebuah dialog akan meminta Anda memasukkan kata sandi untuk mengonfirmasi penghapusan. Setelah dikonfirmasi, semua data Anda, termasuk catatan sidat yang telah Anda masukkan, akan dihapus selamanya dari database.

---

## Cara Deploy Aplikasi

### Kebutuhan Server

* **PHP >= 8.1:** Termasuk ekstensi umum seperti `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`, dan `GD` (untuk QR Code).
* **Composer:** Versi terbaru direkomendasikan untuk manajemen dependensi PHP.
* **Node.js & NPM:** Dibutuhkan untuk mengelola dan membangun aset frontend.
* **Database:** MySQL 5.7+ atau MariaDB 10.3+ direkomendasikan.
* **Web Server:** Nginx atau Apache. Nginx umumnya lebih disukai karena performanya.

### A. Instalasi di Lingkungan Lokal (Contoh: Laragon)

Proses ini dirancang untuk memulai pengembangan dengan cepat.

1.  **Clone Repository:** Unduh kode sumber dari repositori Git ke direktori `www` Laragon Anda.
    ```bash
    git clone https://github.com/hutrisemendawai/sidaco.git sidat-app
    cd sidat-app
    ```

2.  **Install Dependencies:** `composer install` mengunduh semua pustaka PHP yang diperlukan (seperti Laravel itu sendiri), sementara `npm install` mengunduh semua pustaka JavaScript (seperti Alpine.js dan Tailwind CSS).
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Lingkungan:**
    * Salin file konfigurasi contoh. File `.env` berisi informasi sensitif dan tidak boleh dimasukkan ke dalam Git.
        ```bash
        copy .env.example .env
        ```
    * Buat kunci enkripsi unik.
        ```bash
        php artisan key:generate
        ```
    * Buka file `.env` dan sesuaikan pengaturan database.
        ```dotenv
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=sidat_app
        DB_USERNAME=root
        DB_PASSWORD=
        ```

4.  **Migrasi Database:**
    * Gunakan alat bantu database Laragon untuk membuat database baru.
    * Jalankan perintah migrasi untuk membangun semua tabel yang didefinisikan dalam direktori `database/migrations`.
        ```bash
        php artisan migrate
        ```

5.  **Build Aset Frontend:** Perintah ini akan mengkompilasi dan mem-bundle semua file CSS dan JavaScript Anda menjadi file tunggal yang dioptimalkan untuk produksi.
    ```bash
    npm run build
    ```

6.  **Akses Aplikasi:** Muat ulang Laragon untuk mendaftarkan host virtual baru, lalu akses `http://sidat-app.test` di browser Anda.

### B. Deploy ke Server Produksi

Proses ini memerlukan langkah-langkah tambahan untuk memastikan keamanan dan performa.

1.  **Clone & Install:** Lakukan langkah 1 & 2 di atas pada server Anda (misalnya, di `/var/www/sidat-app`).

2.  **Konfigurasi `.env` untuk Produksi:**
    * Isi detail koneksi database produksi Anda.
    * **Sangat Penting:** Atur variabel berikut:
        ```dotenv
        APP_ENV=production
        APP_DEBUG=false
        ```
        Menonaktifkan debug sangat penting untuk keamanan agar tidak membocorkan informasi sensitif jika terjadi error.

3.  **Jalankan Migrasi & Buat Kunci:**
    ```bash
    php artisan key:generate
    php artisan migrate --force
    ```

4.  **Optimasi Aplikasi:**
    Perintah-perintah ini secara drastis meningkatkan performa dengan membuat *cache*.
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan storage:link
    ```
    Setiap kali Anda mengubah file konfigurasi atau route, Anda harus menjalankan kembali perintah ini.

5.  **Konfigurasi Web Server (Contoh Nginx):**
    * Arahkan *document root* ke direktori `public`.
    * Contoh konfigurasi Nginx yang lebih lengkap:
        ```nginx
        server {
            listen 80;
            server_name yourdomain.com;
            root /var/www/sidat-app/public;
     
            add_header X-Frame-Options "SAMEORIGIN";
            add_header X-Content-Type-Options "nosniff";
     
            index index.php index.html index.htm;
     
            location / {
                try_files $uri $uri/ /index.php?$query_string;
            }
     
            location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
            }
     
            location ~ /\.ht {
                deny all;
            }
        }
        ```

6.  **Atur Hak Akses Folder:**
    Ini adalah langkah keamanan yang krusial. Web server perlu izin tulis ke beberapa direktori untuk berfungsi dengan baik.
    ```bash
    sudo chown -R $USER:www-data /var/www/sidat-app
    sudo find /var/www/sidat-app -type f -exec chmod 664 {} \;    
    sudo find /var/www/sidat-app -type d -exec chmod 775 {} \;
    sudo chown -R www-data:www-data /var/www/sidat-app/storage
    sudo chown -R www-data:www-data /var/www/sidat-app/bootstrap/cache
    ```

Setelah semua langkah ini selesai, aplikasi Anda akan aktif dan berjalan dengan aman dan efisien di server produksi.