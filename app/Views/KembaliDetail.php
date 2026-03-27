<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <h1 class="text-3xl font-bold">Kembalikan Buku</h1>
            <p class="text-blue-100 mt-2">Selesaikan peminjaman buku Anda.</p>
        </div>
    </div>

    <!-- ALERT MESSAGES -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Denda Alert (jika ada) -->
    <?php if ($denda > 0): ?>
        <div class="bg-orange-100 border-l-4 border-orange-500 p-4 mb-6 rounded">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-800 font-semibold text-lg flex items-center">
                        <i class="bi bi-exclamation-circle mr-2 text-2xl"></i>
                        Perhatian: Ada Denda Keterlambatan
                    </p>
                    <p class="text-orange-700 mt-1">Anda akan dikenakan denda karena keterlambatan pengembalian buku.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- FORM PENGEMBALIAN -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- DETAIL BUKU -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 shadow-md sticky top-8">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Detail Buku</h2>
                
                <!-- Cover Buku -->
                <img src="<?= $buku['cover'] ?>" alt="<?= $buku['judul'] ?>" class="w-full h-64 object-cover rounded-lg mb-4">
                
                <!-- Info Buku -->
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 font-semibold">JUDUL</p>
                        <p class="font-bold text-slate-800"><?= $buku['judul'] ?></p>
                    </div>
                    
                    <div>
                        <p class="text-gray-600 font-semibold">PENULIS</p>
                        <p class="text-slate-700"><?= $buku['penulis'] ?></p>
                    </div>

                    <div class="border-t pt-3">
                        <p class="text-gray-600 font-semibold">TANGGAL MULAI</p>
                        <p class="text-slate-700"><?= date('d M Y', strtotime($peminjaman['tanggalPinjam'])) ?></p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">TANGGAL KEMBALI TERJADWAL</p>
                        <p class="text-slate-700"><?= date('d M Y', strtotime($peminjaman['tanggalJatuhTempo'])) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM PENGEMBALIAN -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <h2 class="text-xl font-bold text-slate-800 mb-6">Informasi Pengembalian</h2>

                <form action="<?= base_url('/peminjaman/proses-kembalikan') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>
                    <input type="hidden" name="idBookCopy" value="<?= $idBookCopy ?>">

                    <!-- Timeline Peminjaman -->
                    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                        <p class="text-sm text-gray-600 font-semibold mb-4">TIMELINE PEMINJAMAN</p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Tanggal Mulai</p>
                                    <p class="font-semibold text-slate-800"><?= date('d M Y', strtotime($peminjaman['tanggalPinjam'])) ?></p>
                                </div>
                                <i class="bi bi-arrow-right text-gray-400 mx-4"></i>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Tanggal Kembali Terjadwal</p>
                                    <p class="font-semibold text-slate-800"><?= date('d M Y', strtotime($peminjaman['tanggalJatuhTempo'])) ?></p>
                                </div>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded p-2">
                                <p class="text-xs text-blue-800">
                                    <i class="bi bi-info-circle mr-1"></i>
                                    Total durasi peminjaman: <strong><?= floor((strtotime($peminjaman['tanggalJatuhTempo']) - strtotime($peminjaman['tanggalPinjam'])) / (60 * 60 * 24)) ?> hari</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Pengembalian -->
                    <div>
                        <label for="tanggal_pengembalian" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Pengembalian Hari Ini</label>
                        <input type="date" id="tanggal_pengembalian" value="<?= $tanggal_pengembalian ?>" disabled class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-100 text-slate-700">
                        <p class="text-xs text-gray-500 mt-1"><?= date('d M Y', strtotime($tanggal_pengembalian)) ?></p>
                    </div>

                    <!-- Perhitungan Denda -->
                    <div class="<?= $denda > 0 ? 'bg-red-50 border-2 border-red-300' : 'bg-green-50 border-2 border-green-300' ?> rounded-lg p-4">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Status Pengembalian:</span>
                                <span class="font-bold <?= $denda > 0 ? 'text-red-600' : 'text-green-600' ?>">
                                    <?= $denda > 0 ? 'TERLAMBAT' : 'TEPAT WAKTU' ?>
                                </span>
                            </div>
                            <?php if ($denda > 0): ?>
                                <div class="flex justify-between items-center pt-2 border-t">
                                    <span class="text-gray-700">Hari keterlambatan:</span>
                                    <span class="font-bold text-red-600"><?= floor((strtotime($tanggal_pengembalian) - strtotime($peminjaman['tanggalJatuhTempo'])) / (60 * 60 * 24)) ?> hari</span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t">
                                    <span class="text-gray-700">Tarif denda:</span>
                                    <span class="font-bold text-red-600">Rp 5.000 / hari</span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t-2 border-red-400">
                                    <span class="text-lg font-bold text-red-700">Total Denda:</span>
                                    <span class="text-2xl font-bold text-red-600">Rp <?= number_format($denda, 0, ',', '.') ?></span>
                                </div>
                            <?php else: ?>
                                <div class="flex justify-between items-center pt-2 border-t">
                                    <span class="text-lg font-bold text-green-700">Total Denda:</span>
                                    <span class="text-2xl font-bold text-green-600">Rp 0</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Info Penting -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                        <p class="text-sm text-blue-800">
                            <span class="font-semibold">ℹ️ Informasi:</span> Pastikan buku dalam kondisi baik. Jika ada kerusakan pada buku, biaya ganti akan ditambahkan.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition">
                            <i class="bi bi-check-circle mr-2"></i>Konfirmasi Pengembalian
                        </button>
                        <a href="<?= base_url('/peminjamanku') ?>" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 rounded-lg transition text-center">
                            <i class="bi bi-arrow-left mr-2"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
