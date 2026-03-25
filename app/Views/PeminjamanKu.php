<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <!-- HEADER -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">Peminjamanku</h1>
                    <p class="text-blue-100 text-lg">Kelola semua peminjaman buku dengan mudah</p>
                </div>
                <i class="bi bi-bookmarks text-5xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- ALERT MESSAGES -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-50 border-2 border-green-400 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center gap-3 shadow-md animate-pulse">
            <i class="bi bi-check-circle-fill text-2xl text-green-600"></i>
            <div>
                <p class="font-semibold">Berhasil!</p>
                <p class="text-sm"><?= session()->getFlashdata('success') ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- DAFTAR PEMINJAMAN -->
    <div class="bg-white rounded-3xl p-8 shadow-lg">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-800 mb-2 flex items-center gap-2">
                Daftar Peminjaman Aktif
            </h2>
            <div class="h-1 w-12 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full"></div>
        </div>

        <?php if (empty($peminjaman)): ?>
            <div class="text-center py-16 px-8">
                <div class="mb-4">
                    <i class="bi bi-inbox text-6xl text-gray-300 block mb-4"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-500 mb-2">Belum Ada Peminjaman</h3>
                <p class="text-gray-400 mb-6">Anda belum memiliki peminjaman buku yang aktif.</p>
                <a href="<?= base_url('/katalog') ?>" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                    <i class="bi bi-search"></i>
                    Jelajahi Katalog Buku
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($peminjaman as $p): ?>
                    <div class="group bg-gradient-to-br from-slate-50 to-gray-50 border-2 border-gray-200 hover:border-blue-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-xl hover:scale-[1.01] cursor-pointer">
                        <div class="flex gap-6 items-start">
                            <!-- Cover -->
                            <div class="flex-shrink-0">
                                <div class="w-24 h-36 rounded-xl overflow-hidden shadow-md group-hover:shadow-lg transition-shadow">
                                    <img src="<?= $p['cover'] ?>" alt="<?= $p['judul'] ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="flex-1 min-w-0">
                                <!-- Judul & Penulis -->
                                <div class="mb-3">
                                    <h3 class="font-bold text-lg text-slate-800 mb-1 truncate"><?= $p['judul'] ?></h3>
                                    <p class="text-sm text-gray-600 flex items-center gap-1">
                                        <i class="bi bi-pen"></i>
                                        <?= $p['penulis'] ?>
                                    </p>
                                </div>

                                <!-- Tanggal -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 p-4 bg-white rounded-lg border border-gray-200">
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Mulai</p>
                                        <p class="text-sm font-bold text-slate-800"><?= date('d M Y', strtotime($p['tanggal_mulai'])) ?></p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Kembali</p>
                                        <p class="text-sm font-bold text-slate-800"><?= date('d M Y', strtotime($p['tanggal_kembali'])) ?></p>
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Durasi</p>
                                        <p class="text-sm font-bold text-slate-800">
                                            <?= floor((strtotime($p['tanggal_kembali']) - strtotime($p['tanggal_mulai'])) / (60 * 60 * 24)) ?> hari
                                        </p>
                                    </div>
                                </div>

                                <!-- Status & Sisa Hari -->
                                <div class="flex flex-wrap items-center gap-3 mb-4">
                                    <?php if ($p['status'] === 'telat'): ?>
                                        <span class="inline-flex items-center gap-2 bg-red-50 border-2 border-red-400 text-red-700 px-4 py-2 rounded-lg font-semibold text-sm">
                                            <i class="bi bi-exclamation-circle-fill text-lg"></i>
                                            Telat <?= $p['hari_sisa'] ?> hari
                                        </span>
                                        <span class="inline-flex items-center gap-2 bg-orange-50 border-2 border-orange-400 text-orange-700 px-4 py-2 rounded-lg font-semibold text-sm">
                                            <i class="bi bi-currency-dollar"></i>
                                            Rp <?= number_format($p['denda'], 0, ',', '.') ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-2 bg-green-50 border-2 border-green-400 text-green-700 px-4 py-2 rounded-lg font-semibold text-sm">
                                            <i class="bi bi-calendar-check-fill"></i>
                                            <?= $p['hari_sisa'] ?> hari lagi
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Buttons -->
                                <div class="flex flex-wrap gap-3">
                                    <a href="<?= base_url('/peminjaman/perpanjang/' . $p['index']) ?>" class="flex items-center gap-2 px-5 py-2 border-2 border-blue-500 bg-blue-50 text-blue-600 hover:bg-blue-500 hover:text-white font-semibold rounded-lg transition-all duration-300 hover:shadow-md">
                                        <i class="bi bi-arrow-repeat"></i>
                                        <span>Perpanjang</span>
                                    </a>
                                    <a href="<?= base_url('/peminjaman/kembalikan/' . $p['index']) ?>" class="flex items-center gap-2 px-5 py-2 border-2 border-red-500 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white font-semibold rounded-lg transition-all duration-300 hover:shadow-md">
                                        <i class="bi bi-box-seam"></i>
                                        <span>Kembalikan</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Summary Card -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-300 rounded-2xl p-6 text-center">
                    <i class="bi bi-book text-4xl text-blue-600 mb-2 block"></i>
                    <p class="text-sm text-blue-700 font-semibold uppercase">Total Peminjaman</p>
                    <p class="text-4xl font-bold text-blue-900"><?= count($peminjaman) ?></p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-300 rounded-2xl p-6 text-center">
                    <i class="bi bi-check-circle text-4xl text-green-600 mb-2 block"></i>
                    <p class="text-sm text-green-700 font-semibold uppercase">Aktif</p>
                    <p class="text-4xl font-bold text-green-900">
                        <?= count(array_filter($peminjaman, fn($p) => $p['status'] === 'aktif')) ?>
                    </p>
                </div>

                <div class="bg-gradient-to-br from-red-50 to-red-100 border-2 border-red-300 rounded-2xl p-6 text-center">
                    <i class="bi bi-exclamation-circle text-4xl text-red-600 mb-2 block"></i>
                    <p class="text-sm text-red-700 font-semibold uppercase">Telat</p>
                    <p class="text-4xl font-bold text-red-900">
                        <?= count(array_filter($peminjaman, fn($p) => $p['status'] === 'telat')) ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
