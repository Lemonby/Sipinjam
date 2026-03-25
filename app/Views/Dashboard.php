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
            <h3 class="text-4xl font-bold text-blue-600 mt-2">3</h3>
            <p class="text-gray-500 text-xs mt-1">Aktif dipinjam</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-purple-600">
            <p class="text-gray-600 text-sm font-medium">Buku Dipinjam</p>
            <h3 class="text-4xl font-bold text-purple-600 mt-2">3</h3>
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
                    <a href="#" class="text-blue-500 hover:text-blue-600 text-sm font-medium">Lihat Semua</a>
                </div>

                <!-- Card Buku 1 -->
                <div class="flex gap-4 pb-4 border-b border-gray-200 mb-4">
                    <div class="w-20 h-28 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                        Atomic Habit
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-slate-800">Atomic Habit</h3>
                        <p class="text-sm text-gray-600">James Clare</p>
                        <div class="flex items-center gap-2 mt-2 text-orange-500">
                            <i class="bi bi-hourglass-split text-sm"></i>
                            <span class="text-sm">3 Hari Lagi</span>
                        </div>
                        <button class="mt-3 px-4 py-1 border-2 border-blue-500 text-blue-500 hover:bg-blue-50 rounded-lg text-sm font-medium transition">
                            Perpanjang
                        </button>
                    </div>
                </div>

                <!-- Card Buku 2 -->
                <div class="flex gap-4 pb-4 border-b border-gray-200 mb-4">
                    <div class="w-20 h-28 bg-gradient-to-br from-gray-700 to-black rounded-lg flex items-center justify-center text-white text-xs font-bold text-center px-1">
                        Psyco logy Of Money
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-slate-800">Psychology Of Money</h3>
                        <p class="text-sm text-gray-600">James Clare</p>
                        <div class="flex items-center gap-2 mt-2 text-orange-500">
                            <i class="bi bi-hourglass-split text-sm"></i>
                            <span class="text-sm">5 Hari Lagi</span>
                        </div>
                        <button class="mt-3 px-4 py-1 border-2 border-blue-500 text-blue-500 hover:bg-blue-50 rounded-lg text-sm font-medium transition">
                            Perpanjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Section Rekomendasi Untukmu -->
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Rekomendasi Untukmu</h2>
                    <div class="flex gap-2">
                        <button class="p-2 border border-gray-300 rounded-full hover:bg-gray-100 transition">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="p-2 border border-gray-300 rounded-full hover:bg-gray-100 transition">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Grid Buku Rekomendasi -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <!-- Book 1 -->
                    <div class="text-left">
                        <div class="w-full h-32 bg-gradient-to-br from-yellow-300 to-yellow-600 rounded-lg mb-2 flex items-center justify-center">
                            <i class="bi bi-book text-white text-2xl"></i>
                        </div>
                        <p class="text-xs font-medium text-green-600 bg-green-100 rounded-full px-2 py-1 inline-block mb-1">Tersedia</p>
                        <h4 class="font-semibold text-sm text-slate-800">Harry Potter</h4>
                        <p class="text-xs text-gray-600">James Clare</p>
                    </div>

                    <!-- Book 2 -->
                    <div class="text-left">
                        <div class="w-full h-32 bg-gradient-to-br from-gray-800 to-black rounded-lg mb-2 flex items-center justify-center">
                            <i class="bi bi-book text-white text-2xl"></i>
                        </div>
                        <p class="text-xs font-medium text-green-600 bg-green-100 rounded-full px-2 py-1 inline-block mb-1">Tersedia</p>
                        <h4 class="font-semibold text-sm text-slate-800">Memory</h4>
                        <p class="text-xs text-gray-600">James Clare</p>
                    </div>

                    <!-- Book 3 -->
                    <div class="text-left">
                        <div class="w-full h-32 bg-gradient-to-br from-red-600 to-red-800 rounded-lg mb-2 flex items-center justify-center">
                            <i class="bi bi-book text-white text-2xl"></i>
                        </div>
                        <p class="text-xs font-medium text-green-600 bg-green-100 rounded-full px-2 py-1 inline-block mb-1">Tersedia</p>
                        <h4 class="font-semibold text-sm text-slate-800">Ladybird</h4>
                        <p class="text-xs text-gray-600">James Clare</p>
                    </div>

                    <!-- Book 4 -->
                    <div class="text-left">
                        <div class="w-full h-32 bg-gradient-to-br from-amber-700 to-yellow-900 rounded-lg mb-2 flex items-center justify-center">
                            <i class="bi bi-book text-white text-2xl"></i>
                        </div>
                        <p class="text-xs font-medium text-green-600 bg-green-100 rounded-full px-2 py-1 inline-block mb-1">Tersedia</p>
                        <h4 class="font-semibold text-sm text-slate-800">Kepada yang hilang</h4>
                        <p class="text-xs text-gray-600">James Clare</p>
                    </div>
                </div>
            </div>
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