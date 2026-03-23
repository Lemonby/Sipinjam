<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER -->
    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl p-8 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold">Peminjamanku</h1>
        <p class="text-blue-100 mt-2">Kelola semua peminjaman buku Anda di sini.</p>
    </div>

    <!-- DAFTAR PEMINJAMAN -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <h2 class="text-xl font-bold text-slate-800 mb-6">Daftar Peminjaman Aktif</h2>

        <div class="space-y-4">
            <!-- Peminjaman 1 -->
            <div class="flex gap-4 pb-4 border-b border-gray-200">
                <div class="w-20 h-28 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                    Book 1
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-slate-800">Judul Buku</h3>
                    <p class="text-sm text-gray-600">Penulis: Nama Penulis</p>
                    <div class="flex items-center gap-2 mt-2 text-orange-500">
                        <i class="bi bi-calendar-event text-sm"></i>
                        <span class="text-sm">Dipinjam: 15 Mar 2026</span>
                    </div>
                    <div class="flex items-center gap-2 mt-1 text-orange-500">
                        <i class="bi bi-hourglass-split text-sm"></i>
                        <span class="text-sm">Kembali: 22 Mar 2026</span>
                    </div>
                    <div class="flex gap-2 mt-3">
                        <button class="px-4 py-1 border-2 border-blue-500 text-blue-500 hover:bg-blue-50 rounded-lg text-sm font-medium transition">
                            Perpanjang
                        </button>
                        <button class="px-4 py-1 border-2 border-red-500 text-red-500 hover:bg-red-50 rounded-lg text-sm font-medium transition">
                            Kembalikan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Peminjaman 2 -->
            <div class="flex gap-4 pb-4 border-b border-gray-200">
                <div class="w-20 h-28 bg-gradient-to-br from-gray-700 to-black rounded-lg flex items-center justify-center text-white text-xs font-bold text-center px-1">
                    Book 2
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-slate-800">Judul Buku Lainnya</h3>
                    <p class="text-sm text-gray-600">Penulis: Nama Penulis</p>
                    <div class="flex items-center gap-2 mt-2 text-orange-500">
                        <i class="bi bi-calendar-event text-sm"></i>
                        <span class="text-sm">Dipinjam: 10 Mar 2026</span>
                    </div>
                    <div class="flex items-center gap-2 mt-1 text-orange-500">
                        <i class="bi bi-hourglass-split text-sm"></i>
                        <span class="text-sm">Kembali: 17 Mar 2026</span>
                    </div>
                    <div class="flex gap-2 mt-3">
                        <button class="px-4 py-1 border-2 border-blue-500 text-blue-500 hover:bg-blue-50 rounded-lg text-sm font-medium transition">
                            Perpanjang
                        </button>
                        <button class="px-4 py-1 border-2 border-red-500 text-red-500 hover:bg-red-50 rounded-lg text-sm font-medium transition">
                            Kembalikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
