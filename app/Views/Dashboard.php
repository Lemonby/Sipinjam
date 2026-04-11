<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER GREETING -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <p class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm font-medium mb-2">
                <i class="bi bi-hand-thumbs-up"></i> Selamat datang kembali.
            </p>
            <h1 class="text-4xl font-bold">Halo, <?= esc($user['nama']) ?>! 👋</h1>
            <p class="text-blue-100 mt-2">Berikut adalah ringkasan aktivitas perpustakaan kamu hari ini.</p>
        </div>
    </div>    

    <!-- STATISTIK CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-blue-600">
            <p class="text-gray-600 text-sm font-medium">Buku Dipinjam</p>
            <h3 class="text-4xl font-bold text-blue-600 mt-2"><?= $dataUser[0]['totalDipinjam'] ?? 0 ?></h3>
            <p class="text-gray-500 text-xs mt-1">Aktif dipinjam</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-purple-600">
            <p class="text-gray-600 text-sm font-medium">Buku Dipinjam</p>
            <h3 class="text-4xl font-bold text-purple-600 mt-2"><?= $dataUser[0]['totalDipinjam'] ?? 0 ?></h3>
            <p class="text-gray-500 text-xs mt-1">Total bulan ini</p>
        </div>
    </div>

    <!-- CONTAINER UTAMA: Peminjamanku + RIGHT SIDEBAR -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- PEMINJAMANKU (MAIN) -->
        <div class="lg:col-span-2">
            <!-- Section Peminjamanku -->
            <div class="bg-white rounded-2xl p-6 shadow-md mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Peminjamanku</h2>
                    <a href="<?= base_url('/peminjamanku') ?>" class="text-blue-500 hover:text-blue-600 text-sm font-medium">Lihat Semua</a>
                </div>

                <?php if ($dataUser[0]['totalDipinjam'] == 0): ?>
                    <div class="flex flex-col items-center gap-4 py-10">
                        <i class="bi bi-book text-gray-400 text-6xl"></i>
                        <p class="text-gray-600 text-sm">Kamu belum meminjam buku apapun. Ayo jelajahi katalog dan temukan buku favoritmu!</p>
                    </div>
                    
                <?php else: ?>
                    <!-- Card Buku Aktif -->
                    <?php foreach ($dataUser as $buku): ?>
                        <div class="flex gap-4 pb-4 border-b border-gray-200 mb-4 group hover:bg-gray-50 p-2 rounded-lg transition-all duration-300">
                            <div class="w-20 h-28 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0 shadow-md overflow-hidden">
                                <img src="<?= base_url('assets/images/' . $buku['coverBuku']) ?>" alt="Cover Buku" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-slate-800"><?= $buku['judulBuku'] ?></h3>
                                <p class="text-sm text-gray-600"><?= $buku['penulisBuku'] ?></p>
                                <div class="flex items-center gap-2 mt-2 text-orange-500">
                                    <i class="bi bi-hourglass-split text-sm"></i>
                                    <span class="text-sm font-medium"><?= $buku['sisaHari'] ?> Hari Lagi</span>
                                </div>
                                <div class="flex items-center mt-3 gap-2">
                                    <a href="<?= base_url('/peminjaman/perpanjang/' . $buku['idBookCopy']) ?>" class="focus:outline-none gap-2 px-3 py-1.5 bg-blue-50 border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded-lg text-sm font-semibold transition-all duration-300 flex items-center">
                                        <i class="bi bi-arrow-repeat text-sm"></i>
                                        <span>Perpanjang</span>
                                    </a>
                                    <a href="<?= base_url('/peminjaman/kembalikan/' . $buku['idBookCopy']) ?>" class="focus:outline-none gap-2 px-3 py-1.5 bg-green-50 border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded-lg text-sm font-semibold transition-all duration-300 flex items-center">
                                        <i class="bi bi-check-circle text-sm"></i>
                                        <span>Kembalikan</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Section Rekomendasi Untukmu -->
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Rekomendasi Untukmu</h2>
                    <div class="flex gap-2">
                        <button id="scrollLeft" class="p-2 border border-gray-300 rounded-full hover:bg-gray-100 transition cursor-pointer">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button id="scrollRight" class="p-2 border border-gray-300 rounded-full hover:bg-gray-100 transition cursor-pointer">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Horizontal Scrollable Container -->
                <div id="booksScroller" class="flex gap-4 overflow-x-auto pb-2 scroll-smooth" style="scroll-behavior: smooth;">
                    <?php foreach($dataKatalog as $katalog): ?> 
                        <a href="<?= base_url('/peminjaman/' . $katalog['id']) ?>" class="flex-shrink-0 w-44 text-left group cursor-pointer hover:scale-105 transition-transform duration-300">
                            <div class="w-full h-56 bg-gradient-to-br from-amber-700 to-yellow-900 rounded-xl mb-3 flex items-center justify-center group-hover:shadow-xl transition-all duration-300 overflow-hidden shadow-md">
                                <img src="<?= base_url('assets/images/' . $katalog['cover']) ?>" alt="<?= $katalog['judul'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <?php if ($katalog['statusTersedia'] > 0): ?>
                                <p class="text-xs font-semibold text-green-600 bg-green-100 rounded-full px-2.5 py-1 inline-block mb-2"><?= $katalog['statusTersedia'] ?> Tersedia</p>
                            <?php else: ?>
                                <p class="text-xs font-semibold text-red-600 bg-red-100 rounded-full px-2.5 py-1 inline-block mb-2">Tidak Tersedia</p>
                            <?php endif; ?>
                            <h4 class="font-bold text-sm text-slate-800 truncate group-hover:text-blue-600 transition-colors"><?= $katalog['judul'] ?></h4>
                            <p class="text-xs text-gray-600 truncate group-hover:text-gray-700"><?= $katalog['penulis'] ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <script>
                const scroller = document.getElementById('booksScroller');
                const scrollLeft = document.getElementById('scrollLeft');
                const scrollRight = document.getElementById('scrollRight');
                
                const scrollAmount = 320; // Width of item + gap
                
                // Arrow button functionality
                scrollLeft.addEventListener('click', () => {
                    scroller.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });
                
                scrollRight.addEventListener('click', () => {
                    scroller.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
                
                // Drag functionality
                let isDown = false;
                let startX;
                let scrollLeft_;
                
                scroller.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - scroller.offsetLeft;
                    scrollLeft_ = scroller.scrollLeft;
                    scroller.style.cursor = 'grabbing';
                    scroller.style.scrollBehavior = 'auto';
                });
                
                scroller.addEventListener('mouseleave', () => {
                    isDown = false;
                    scroller.style.cursor = 'auto';
                    scroller.style.scrollBehavior = 'smooth';
                });
                
                scroller.addEventListener('mouseup', () => {
                    isDown = false;
                    scroller.style.cursor = 'auto';
                    scroller.style.scrollBehavior = 'smooth';
                });
                
                scroller.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - scroller.offsetLeft;
                    const walk = (x - startX) * 1;
                    scroller.scrollLeft = scrollLeft_ - walk;
                });
                
                // Touch drag for mobile
                scroller.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].pageX - scroller.offsetLeft;
                    scrollLeft_ = scroller.scrollLeft;
                });
                
                scroller.addEventListener('touchmove', (e) => {
                    const x = e.touches[0].pageX - scroller.offsetLeft;
                    const walk = (x - startX) * 1;
                    scroller.scrollLeft = scrollLeft_ - walk;
                });
            </script>
        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="lg:col-span-1 space-y-6">
            <!-- NOTIFIKASI -->
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <div class="flex items-center gap-2 mb-4">
                    <i class="bi bi-bell text-blue-500 text-lg"></i>
                    <h3 class="font-bold text-lg text-slate-800">Notifikasi</h3>
                    <span class="ml-auto bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">1</span>
                </div>

                <div class="space-y-3">
                    <!-- Notification 1 -->
                    <div class="p-3 border-l-4 border-blue-500 bg-blue-50 rounded">
                        <p class="text-sm font-semibold text-slate-800">Reservasi Buku "Clean Code" sudah tersedia</p>
                        <p class="text-xs text-gray-600 mt-1">10 menit yang lalu</p>
                    </div>

                    <!-- Notification 2 -->
                    <div class="p-3 border-l-4 border-gray-300 bg-gray-50 rounded">
                        <p class="text-sm font-semibold text-slate-800">Masa pinjam "The Pragmatic Programmer" akan habis dalam 3 hari</p>
                        <p class="text-xs text-gray-600 mt-1">Kemarin, 14:30</p>
                    </div>
                </div>
            </div>

            <!-- JAM OPERASIONAL -->
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <h3 class="font-bold text-lg text-slate-800 mb-4">Jam Operasional</h3>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Senin - Jumat</p>
                        <p class="text-sm text-gray-600">08:00 - 18:00</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-700">Sabtu</p>
                        <p class="text-sm text-gray-600">09:00 - 15:00</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-red-600">Minggu</p>
                        <p class="text-sm text-red-500">Tutup</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

<?= $this->endSection() ?>