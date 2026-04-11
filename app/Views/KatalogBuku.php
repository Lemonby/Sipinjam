<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <!-- HEADER -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Katalog Buku</h1>
                    <p class="text-blue-100">Jelajahi koleksi lengkap perpustakaan kami</p>
                </div>
                <i class="bi bi-book-half text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="bg-white rounded-3xl p-8 shadow-lg">
        <!-- SECTION TITLE -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-2 flex items-center gap-3">
                Rekomendasi untuk Kamu
            </h2>
            <div class="h-1 w-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative group">
                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="search" id="search" placeholder="Cari buku berdasarkan judul..." class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-400 transition-all duration-200" />
                </div>
                <div class="relative group">
                    <i class="bi bi-funnel absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" name="filter" id="filter" placeholder="Filter berdasarkan penulis..." class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-400 transition-all duration-200" />
                </div>
            </div>
        </div>

        <!-- BOOK GRID -->
        <?php if (empty($books)): ?>
            <div class="text-center py-16">
                <i class="bi bi-inbox text-6xl text-gray-300 block mb-4"></i>
                <h3 class="text-2xl font-semibold text-gray-500 mb-2">Belum Ada Buku</h3>
                <p class="text-gray-400">Koleksi buku sedang diperbarui. Silakan cek kembali nanti.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <?php foreach ($books as $book): ?>
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:scale-102 hover:-translate-y-2">
                        <!-- Cover Image -->
                        <div class="relative h-56 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
                            <img src="<?= $book['cover'] ?>" alt="<?= $book['judul'] ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>

                        <!-- Book Info -->
                        <div class="p-5">
                            <!-- Status Badge -->
                            <div class="mb-3">
                                <?php if ($book['statusTersedia'] > 0): ?>
                                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-600 px-3 py-1.5 rounded-full text-xs font-bold">
                                        <i class="bi bi-check-circle"></i>
                                        Tersedia
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-full text-xs font-bold">
                                        <i class="bi bi-x-circle"></i>
                                        Tidak Tersedia
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h3 class="font-bold text-slate-800 text-sm mb-1 line-clamp-2 min-h-10">
                                <?= $book['judul'] ?>
                            </h3>

                            <!-- Author -->
                            <p class="text-xs text-gray-600 mb-4 flex items-center gap-1 line-clamp-1">
                                <i class="bi bi-person-fill text-gray-400"></i>
                                <?= $book['penulis'] ?>
                            </p>

                            <!-- Button -->
                            <div class="pt-3 border-t-2 border-gray-100">
                                <?php if ($book['statusTersedia'] > 0): ?>
                                    <a href="<?= base_url('/peminjaman/' . $book['id']) ?>" class="flex items-center justify-center gap-2 w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2.5 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg group/btn">
                                        <i class="bi bi-bag-check-fill group-hover/btn:scale-110 transition-transform"></i>
                                        <span>Pinjam</span>
                                    </a>
                                <?php else: ?>
                                    <button disabled class="flex items-center justify-center gap-2 w-full bg-gray-300 text-gray-600 font-bold py-2.5 rounded-lg cursor-not-allowed opacity-60">
                                        <i class="bi bi-lock-fill"></i>
                                        <span>Tidak Tersedia</span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Footer Info -->
            <div class="mt-12 text-center">
                <div class="inline-block bg-blue-50 border-2 border-blue-300 rounded-xl px-6 py-4">
                    <p class="text-sm text-gray-600">
                        <i class="bi bi-info-circle text-blue-600 mr-2"></i>
                        Menampilkan <strong><?= count($books) ?></strong> buku dari koleksi perpustakaan kami
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>