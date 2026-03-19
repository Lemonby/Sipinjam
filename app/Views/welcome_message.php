<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <title>Perpustakaan Online</title>
</head>
<body class="bg-blue-50 py-4 px-8 rounded-lg">

  <!-- section hero -->
  <div class="bg-blue-500 text-white p-8 rounded-lg text-left max-w-7xl mx-auto mt-8">
    <span class="font-medium text-sm bg-blue-100 rounded-2xl p-1 mb-2">khusus mahasiswa cerdas</span>
    <h6 class="font-bold text-4xl max-w-lg capitalize mt-2 mb-8">Akses  Ribuan Pengetahuan dalam satu klik</h6>
    <p class="text-white text-medium max-w-150 mb-8">pinjam buku favoritmu secara online, ambil di perpustakaan tanpa antre, khusus mahasiswa cerdas, gratis dan murah!</p>
    <div class="flex gap-4">
      <button class="bg-white hover:bg-blue-700 text-blue-500 font-bold py-2 px-4 rounded">Pinjam Sekarang</button>
      <button class="bg-blue-500 hover:bg-blue-700 ring-2 text-white font-bold py-2 px-4 rounded">Lihat Detail</button>
    </div>
  </div>

  <!-- section card features -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-16 mt-8 max-w-7xl mx-auto">
    <div class="bg-white p-2 rounded-lg shadow max-w-lg items-center text-center leading-8">
      <div class="text-blue-500 text-2xl mt-4">
      <i class="bi bi-journals bg-blue-100 p-3 rounded-full"></i>
      </div>
      <h6 class="text-2xl font-bold text-blue-500 mt-6 mb-1">5.000+</h6> 
      <p class="text-gray-500 text-medium">Koleksi Buku</p>
    </div>
    <div class="bg-white p-2 rounded-lg shadow max-w-lg items-center text-center leading-8">
      <div class="text-orange-500 text-2xl mt-4">
        <i class="bi bi-stack bg-orange-100 p-3 rounded-full"></i>
      </div>
      <h6 class="text-2xl font-bold text-orange-500 mt-6 mb-1">20+</h6>
      <p class="text-gray-500 text-medium">Kategori Bidang</p>
    </div>
    <div class="bg-white p-2  rounded-lg shadow max-w-lg items-center text-center leading-8">
      <div class="text-green-500 text-2xl mt-4">
        <i class="bi bi-people bg-green-100 p-3 rounded-full"></i>
      </div>
      <h6 class="text-2xl font-bold text-green-500 mt-6 mb-1">1.200</h6>
      <p class="text-gray-500 text-medium">Pengguna Aktif</p>
    </div>
    <div class="bg-white p-2 rounded-lg shadow max-w-lg items-center text-center leading-8">
      <div class="text-purple-500 text-2xl mt-4">
        <i class="bi bi-clock bg-purple-100 p-3 rounded-full"></i>
      </div>
      <h6 class="text-2xl font-bold text-purple-500 mt-6 mb-1"> < 5 Menit</h6>
      <p class="text-gray-500 text-medium">Proses Cepat</p>
    </div>
  </div>

  <!-- section judul untuk kategori buku -->
  <div class="text-center mt-22 mb-10 max-w-7xl mx-auto ">
    <h5 class="text-2xl font-bold text-black mb-4">Kategori Buku Unggulan</h5>
    <p class="text-gray-500">Temukan koleksi terbaik kamu yang disesuaikan dengan kebutuhan akademik kamu.</p>
  </div>

  <!-- section card kategori buku -->
  <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-8 max-w-7xl mx-auto">
    <div class="bg-blue-100 p-6 rounded-lg max-w-3xl items-center">
      <div class="text-white text-2xl mb-4">
        <i class="bi bi-filetype-pdf bg-blue-500 p-3 rounded-lg"></i>
      </div>
      <h5 class="text-2xl font-semibold text-black mb-4">E-Book & Jurnal</h5>
      <p class="text-gray-500 text-medium">Akses koleksi digital lengkap dengan ribuan e-book dan jurnal ilmiah terkini dari berbagai penerbit internasional.</p>
      <div class="flex items-center gap-2 mt-4 text-blue-500 font-medium">
        <p>Jelajahi Koleksi</p>
        <i class="bi bi-arrow-right text-semibold"></i>
      </div>
    </div>
    <div class="bg-orange-100 p-6 rounded-lg max-w-3xl items-center">
      <div class="text-white text-2xl mb-4">
        <i class="bi bi-code-slash bg-orange-500 p-3 rounded-lg"></i>
      </div>
      <h5 class="text-2xl font-semibold text-black mb-4">Teknologi & Koding</h5>
      <p class="text-gray-500 text-medium">Pelajari bahasa pemrograman, framework terbaru, dan best practices dari buku-buku coding pilihan para expert.</p>
      <div class="flex items-center gap-2 mt-4 text-orange-500 font-medium">
        <p>Jelajahi Koleksi</p>
        <i class="bi bi-arrow-right text-semibold"></i>
      </div>
    </div>
    <div class="bg-yellow-100 p-6 rounded-lg max-w-3xl items-center">
      <div class="text-white text-2xl mb-4">
        <i class="bi bi-calendar2-week bg-yellow-500 p-3 rounded-lg"></i>
      </div>
      <h5 class="text-2xl font-semibold text-black mb-4">Sistem Reservasi</h5>
      <p class="text-gray-500 text-medium">Akses koleksi digital lengkap dengan ribuan e-book dan jurnal ilmiah terkini dari berbagai penerbit internasional.</p>
      <div class="flex items-center gap-2 mt-4 text-yellow-500 font-medium">
        <p>Mulai Reservassi</p>
        <i class="bi bi-arrow-right text-semibold"></i>
      </div>
    </div>
    <div class="bg-[#a0e1ee] p-6 rounded-lg max-w-3xl items-center">
      <div class="text-white text-2xl mb-4">
        <i class="bi bi-shield-shaded bg-[#08BEE1] p-3 rounded-lg"></i>
      </div>
      <h5 class="text-2xl font-semibold text-black mb-4">Bebas Denda</h5>
      <p class="text-gray-500 text-medium">Nikmati kemudahan perpanjangan otomatis dan sistem reminder pintar agar kamu tidak terkena denda keterlambatan.</p>
      <div class="flex items-center gap-2 mt-4 text-[#008FB0] font-medium">
        <p>Jelajahi Lebih Lanjut</p>
        <i class="bi bi-arrow-right text-semibold"></i>
      </div>
    </div>
  </div>

  <!-- section Cara Kerja Sistem Peminjaman -->
  <div class="text-center mt-22 mb-10 max-w-7xl mx-auto ">
    <h5 class="text-2xl font-bold text-black mb-4">Cara Kerja Sistem Peminjaman</h5>
    <p class="text-gray-500">Hanya 3 langkah mudah untuk meminjam buku favoritmu.</p>
  </div>

  <!-- section langkah-langkah cara kerja -->
  <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-8 max-w-7xl mx-auto">
    <div class="flex flex-col p-6 rounded-lg max-w-3xl items-center text-center leading-relaxed">
      <div class="mb-4">
        <div class="w-14 h-14 rounded-full bg-blue-500 text-white text-2xl font-semibold flex items-center justify-center mx-auto">1</div>
      </div>
      <h5 class="text-xl font-semibold text-black mb-4">Cari Buku</h5>
      <p class="text-gray-500 text-medium">Telusuri katalog online dan temukan buku yang kamu butuhkan dengan mudah.</p>
    </div>
    <div class="flex flex-col p-6 rounded-lg max-w-3xl items-center text-center leading-relaxed">
      <div class="mb-4 relative w-full">
        <div class="hidden md:block absolute left-0 right-0 top-1/2 -translate-y-1/2 h-1 rounded-full bg-gradient-to-r from-blue-300 via-orange-300 to-green-300 z-0"></div>
        <div class="relative z-10 w-14 h-14 rounded-full bg-orange-500 text-white text-2xl font-semibold flex items-center justify-center mx-auto">2</div>
      </div>
      <h5 class="text-xl font-semibold text-black mb-4">Lakukan Reservasi</h5>
      <p class="text-gray-500 text-medium">Lakukan reservasi buku yang kamu inginkan dan pilih tanggal pengambilan yang paling nyaman.</p>
    </div>
    <div class="flex flex-col p-6 rounded-lg max-w-3xl items-center text-center leading-relaxed">
      <div class="mb-4">
        <div class="w-14 h-14 rounded-full bg-green-500 text-white text-2xl font-semibold flex items-center justify-center mx-auto">3</div>
      </div>
      <h5 class="text-xl font-semibold text-black mb-4">Ambil Buku</h5>
      <p class="text-gray-500 text-medium">Ambil buku yang telah kamu reservasi di lokasi perpustakaan yang paling nyaman.</p>
    </div>
  </div>

  <!-- section komen -->
  <div class="text-center mt-22 mb-10 max-w-7xl mx-auto ">
    <h5 class="text-2xl font-bold text-black mb-4">Apa Kata Mereka?</h5>
  </div>

  <!-- section card komentar -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-7xl mx-auto">
    <div class="bg-white shadow p-6 rounded-lg max-w-lg items-center text-left leading-relaxed">
      <div class="flex gap-1 text-yellow-400 text-lg mb-4">
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
      </div>
      <p class="text-gray-500 capitalize">"Sistem reservasinya sangat membantu! Tidak perlu lagi antre panjang di perpustakaan. Semua bisa dilakukan dari HP."</p>
      <div class="flex items-center gap-2 mt-4 text-blue-500 font-medium">
        <i class="bi bi-person-circle text-2xl text-gray-400"></i>
        <div class="flex flex-col">
          <p class="font-semibold text-black">John Doe</p>
          <p class="text-gray-500">Teknik Mesin</p>
        </div>
      </div>
    </div>
    <div class="bg-white shadow p-6 rounded-lg max-w-lg items-center text-left leading-relaxed">
      <div class="flex gap-1 text-yellow-400 text-lg mb-4">
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
      </div>
      <p class="text-gray-500 capitalize">"Sistem reservasinya sangat membantu! Tidak perlu lagi antre panjang di perpustakaan. Semua bisa dilakukan dari HP."</p>
      <div class="flex items-center gap-2 mt-4 text-blue-500 font-medium">
        <i class="bi bi-person-circle text-2xl text-gray-400"></i>
        <div class="flex flex-col">
          <p class="font-semibold text-black">John Doe</p>
          <p class="text-gray-500">Teknik Mesin</p>
        </div>
      </div>
    </div>
    <div class="bg-white shadow p-6 rounded-lg max-w-lg items-center text-left leading-relaxed">
      <div class="flex gap-1 text-yellow-400 text-lg mb-4">
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
        <i class="bi bi-star-fill text-yellow-500"></i>
      </div>
      <p class="text-gray-500 capitalize">"Sistem reservasinya sangat membantu! Tidak perlu lagi antre panjang di perpustakaan. Semua bisa dilakukan dari HP."</p>
      <div class="flex items-center gap-2 mt-4 text-blue-500 font-medium">
        <i class="bi bi-person-circle text-2xl text-gray-400"></i>
        <div class="flex flex-col">
          <p class="font-semibold text-black">John Doe</p>
          <p class="text-gray-500">Teknik Mesin</p>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <footer class="mt-16 overflow-hidden -mx-8 -mb-4">
    <div class="bg-[#2f80e7] text-white px-6 py-12 md:px-12">
      <div class="text-center max-w-3xl mx-auto">
        <span class="inline-flex items-center gap-2 bg-white/20 text-white text-sm font-medium px-4 py-1 rounded-full">
          <i class="bi bi-rocket-takeoff-fill text-xs"></i>
          Bergabung dengan 1.200+ Mahasiswa Aktif
        </span>
        <h3 class="text-3xl font-bold mt-6">Siap Menjelajahi Dunia Literasi?</h3>
        <p class="text-blue-100 mt-4 leading-relaxed">Daftar sekarang untuk mendapatkan kartu anggota digital dan mulai pinjam buku pertamamu hari ini! Gratis untuk semua mahasiswa IT.</p>

        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
          <button class="bg-white text-[#2f80e7] font-semibold px-6 py-3 rounded-md hover:bg-blue-50 transition">Daftar Jadi Anggota Sekarang <i class="bi bi-arrow-right"></i></button>
          <button class="border border-white text-white font-semibold px-6 py-3 rounded-md hover:bg-white/10 transition"><i class="bi bi-question-circle mr-1"></i> Pelajari Lebih Lanjut</button>
        </div>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 text-center">
        <div>
          <p class="text-4xl font-bold">100%</p>
          <p class="text-blue-100">Gratis</p>
        </div>
        <div>
          <p class="text-4xl font-bold">24/7</p>
          <p class="text-blue-100">Akses Online</p>
        </div>
        <div>
          <p class="text-4xl font-bold">5.000+</p>
          <p class="text-blue-100">Koleksi Buku</p>
        </div>
        <div>
          <p class="text-4xl font-bold">0</p>
          <p class="text-blue-100">Biaya Pinjam</p>
        </div>
      </div>
    </div>

    <div class="bg-[#021442] text-white px-6 py-10 md:px-12">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 rounded bg-[#2f80e7] flex items-center justify-center text-white font-bold text-xl">S</div>
            <p class="text-2xl font-bold">LibMaster</p>
          </div>
          <p class="text-blue-100 leading-relaxed">Sistem peminjaman buku perpustakaan modern untuk mahasiswa IT. Akses ribuan koleksi buku dengan mudah dan cepat.</p>
          <div class="flex gap-3 mt-4 text-xl text-blue-100">
            <i class="bi bi-instagram"></i>
            <i class="bi bi-facebook"></i>
          </div>
        </div>

        <div>
          <h4 class="font-semibold text-lg mb-3">Menu Cepat</h4>
          <ul class="space-y-2 text-blue-100">
            <li><a href="#" class="hover:text-white">Katalog Buku</a></li>
            <li><a href="#" class="hover:text-white">Cara Peminjaman</a></li>
            <li><a href="#" class="hover:text-white">Faq</a></li>
          </ul>
        </div>

        <div>
          <h4 class="font-semibold text-lg mb-3">Kontak</h4>
          <div class="space-y-2 text-blue-100">
            <p><i class="bi bi-geo-alt-fill mr-2"></i>Jl. Pendidikan No. 123, Jakarta</p>
            <p><i class="bi bi-envelope-fill mr-2"></i>library@universitiy.ac.id</p>
            <p><i class="bi bi-telephone-fill mr-2"></i>(021) 1234-5678</p>
          </div>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>