<?= $this->extends('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER -->
    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl p-8 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold">Riwayat Denda</h1>
        <p class="text-blue-100 mt-2">Lihat riwayat denda peminjaman buku Anda.</p>
    </div>

    <!-- RINGKASAN DENDA -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-blue-500">
            <p class="text-gray-600 text-sm font-medium">Total Denda</p>
            <h3 class="text-4xl font-bold text-blue-600 mt-2">Rp 0</h3>
            <p class="text-gray-500 text-xs mt-1">Hingga saat ini</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-red-500">
            <p class="text-gray-600 text-sm font-medium">Denda Menunggu</p>
            <h3 class="text-4xl font-bold text-red-600 mt-2">Rp 0</h3>
            <p class="text-gray-500 text-xs mt-1">Belum dibayar</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-green-500">
            <p class="text-gray-600 text-sm font-medium">Denda Dibayar</p>
            <h3 class="text-4xl font-bold text-green-600 mt-2">Rp 0</h3>
            <p class="text-gray-500 text-xs mt-1">Sudah diselesaikan</p>
        </div>
    </div>

    <!-- DAFTAR DENDA -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <h2 class="text-xl font-bold text-slate-800 mb-6">Daftar Denda</h2>

        <!-- Tabel Denda -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Judul Buku</th>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Tanggal Terlambat</th>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Hari Terlambat</th>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Biaya Denda</th>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Status</th>
                        <th class="px-4 py-3 text-center text-slate-800 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-3 text-slate-800">Atomic Habits</td>
                        <td class="px-4 py-3 text-gray-600">10 Mar 2026</td>
                        <td class="px-4 py-3 text-gray-600">5 hari</td>
                        <td class="px-4 py-3 font-semibold text-red-600">Rp 25.000</td>
                        <td class="px-4 py-3">
                            <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Belum Dibayar
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button class="text-blue-500 hover:text-blue-700 font-semibold text-sm">
                                Bayar
                            </button>
                        </td>
                    </tr>

                    <!-- Empty State -->
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                            <i class="bi bi-check-circle text-green-500 text-4xl mb-2"></i>
                            <p class="mt-2">Tidak ada denda saat ini. Selamat!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
