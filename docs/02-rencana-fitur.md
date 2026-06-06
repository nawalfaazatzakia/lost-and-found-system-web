# Rencana Fitur

> Dokumentasikan minimal **5 fitur utama** proyek Anda.
> Salin dan ulangi blok di bawah untuk setiap fitur tambahan.

---

## Fitur 1 — [Pelaporan Barang Hilang & Ditemukan]

**Role Penanggung Jawab:** `[Frontend | Backend ]`

**Sumber Data:** `[Internal System]`

**Deskripsi & Ekspektasi:**
`[Mahasiswa dapat mengisi formulir pelaporan barang yang hilang atau yang berhasil ditemukan. Form mencakup nama barang, kategori, lokasi, tanggal kejadian, deskripsi ciri-ciri khusus, foto barang, serta informasi kontak pelapor (nama & nomor WhatsApp). Data yang masuk disimpan ke database dan ditampilkan di halaman daftar laporan terbaru. Diharapkan proses pelaporan selesai dalam kurang dari 2 menit dan langsung terlihat di feed publik setelah tersubmit.]`

---

## Fitur 2 — [Verifikasi Klaim Kepemilikan (Tanya Jawab)]

**Role Penanggung Jawab:** `[Frontend | Backend | Security]`

**Sumber Data:** `[Internal System]`

**Deskripsi & Ekspektasi:**
`[Ketika seorang mahasiswa mengklaim barang yang ditemukan orang lain, sistem akan menampilkan serangkaian pertanyaan rahasia yang harus dijawab untuk membuktikan kepemilikan — misalnya warna bagian dalam, merek, atau isi barang. Jawaban pengklaim dibandingkan secara otomatis dengan data yang diinput penemu saat melaporkan. Sistem menghitung skor kecocokan (0–100%) sebagai acuan awal sebelum diteruskan ke admin. Mahasiswa juga diminta mengupload bukti kepemilikan tambahan seperti foto lama atau nota pembelian. Diharapkan proses ini mencegah klaim palsu secara efektif sebelum sampai ke tahap review manusia.]`

---

## Fitur 3 — [Validasi & Approval oleh Admin]

**Role Penanggung Jawab:** `[Frontend | Backend]`

**Sumber Data:** `[Internal System]`

**Deskripsi & Ekspektasi:**
`[Admin kampus memiliki panel khusus untuk meninjau setiap klaim yang masuk. Panel menampilkan perbandingan jawaban pengklaim vs data penemu secara side-by-side, skor kecocokan otomatis, informasi lengkap kedua pihak (nama, NIM, prodi, nomor WhatsApp), serta bukti yang diunggah. Admin dapat memilih untuk menyetujui atau menolak klaim. Jika disetujui, sistem otomatis mengirim notifikasi ke kedua pihak. Jika ditolak, pengklaim mendapatkan pemberitahuan beserta opsi untuk mengajukan banding dengan bukti tambahan. Target waktu review per klaim: kurang dari 24 jam sejak klaim masuk.]`

---

## Fitur 4 — [Peta Lokasi Pengambilan Barang (Google Maps API)]

**Role Penanggung Jawab:** `[Frontend | Backend]`

**Sumber Data:** `[Third-Party API — Google Maps JavaScript API, Google Maps Directions API]`

**Deskripsi & Ekspektasi:**
`[
Setelah klaim disetujui admin, pemilik barang akan diarahkan ke halaman khusus yang menampilkan lokasi penemu secara visual menggunakan Google Maps embed. Peta menampilkan dua titik: posisi penemu (titik hijau) dan estimasi posisi pemilik (titik biru). Disediakan tombol "Buka Google Maps" yang mengarahkan ke koordinat GPS penemu, serta tombol "Navigasi" yang membuka Google Maps Directions dengan mode jalan kaki. Sistem juga menghitung estimasi jarak dan waktu tempuh secara real-time menggunakan Directions API. Diharapkan pemilik barang dapat langsung menuju lokasi penemu tanpa perlu bertanya manual via WhatsApp untuk urusan arah.]`

---

## Fitur 5 — [Chat Koordinasi antara Pemilik & Penemu]

**Role Penanggung Jawab:** `[Frontend | Backend]`

**Sumber Data:** `[Internal System]`

**Deskripsi & Ekspektasi:**
`[Setelah klaim disetujui, kedua pihak (pemilik dan penemu) dapat berkomunikasi langsung melalui fitur chat dalam aplikasi untuk mengatur waktu dan tempat serah terima barang. Chat bersifat real-time menggunakan WebSocket atau polling, dan hanya bisa diakses oleh dua pihak yang terlibat dalam transaksi tersebut plus admin sebagai pengawas. Riwayat chat disimpan sebagai bukti koordinasi. Diharapkan fitur ini mengurangi ketergantungan pada kontak WhatsApp pribadi dan membuat komunikasi lebih terstruktur serta terdokumentasi dalam sistem.]`

---

## Fitur 6 — [Konfirmasi Serah Terima & Penutupan Laporan]

**Role Penanggung Jawab:** `[Frontend | Backend]`

**Sumber Data:** `[Internal System]`

**Deskripsi & Ekspektasi:**
`[Setelah barang berhasil diserahkan, salah satu pihak (pemilik atau penemu) dapat menekan tombol "Konfirmasi Serah Terima" di aplikasi. Sistem kemudian meminta konfirmasi dari pihak lainnya. Jika keduanya mengonfirmasi, status laporan berubah menjadi "Selesai" dan barang dihapus dari daftar aktif. Data transaksi tetap tersimpan untuk keperluan statistik kampus (jumlah barang berhasil dikembalikan, rata-rata waktu penyelesaian, dll). Diharapkan fitur ini memastikan setiap laporan memiliki siklus hidup yang jelas: dari dilaporkan → diklaim → diverifikasi → diserahterimakan → ditutup.]`

---
