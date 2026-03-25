<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">Reservasi</h1>
                    <p class="text-blue-100 mt-2">Kelola reservasi buku Anda.</p>
                </div>
                <i class="bi bi-calendar-check text-5xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- DAFTAR RESERVASI -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-2 flex items-center gap-2">
                Daftar Reservasi
            </h2>
            <div class="h-1 w-12 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full"></div>
        </div>


        <!-- Tabel Reservasi -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Judul Buku</th>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Penulis</th>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Tanggal Reservasi</th>
                        <th class="px-4 py-3 text-left text-slate-800 font-semibold">Status</th>
                        <th class="px-4 py-3 text-center text-slate-800 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-3 text-slate-800">Clean Code</td>
                        <td class="px-4 py-3 text-gray-600">Robert C. Martin</td>
                        <td class="px-4 py-3 text-gray-600">15 Mar 2026</td>
                        <td class="px-4 py-3">
                            <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Waiting
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button class="text-red-500 hover:text-red-700 font-semibold text-sm">
                                Cancel
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-3 text-slate-800">The Pragmatic Programmer</td>
                        <td class="px-4 py-3 text-gray-600">David Thomas, Andrew Hunt</td>
                        <td class="px-4 py-3 text-gray-600">18 Mar 2026</td>
                        <td class="px-4 py-3">
                            <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Ready
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button class="text-blue-500 hover:text-blue-700 font-semibold text-sm">
                                Pickup
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Empty State (jika tidak ada reservasi) -->
        <div class="text-center py-12 hidden">
            <i class="bi bi-inbox text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500 mt-2">Belum ada reservasi buku.</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
