<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <title>Sipinjam - Sistem Peminjaman Buku</title>
</head>
<body class="m-0 p-0 bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-md flex flex-col h-screen overflow-y-auto">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-200 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center font-bold text-lg flex-shrink-0">
                    S
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800 whitespace-nowrap">Sipinjam</h2>
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="<?= base_url('/dashboard') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-100 text-blue-600 rounded-lg font-medium hover:bg-blue-200 transition duration-200">
                <i class="bi bi-speedometer2 flex-shrink-0"></i>
                <span class="truncate">Dashboard</span>
            </a>
            <a href="<?= base_url('/katalog') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                <i class="bi bi-book flex-shrink-0"></i>
                <span class="truncate">Katalog Buku</span>
            </a>
            <a href="<?= base_url('/peminjamanku') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                <i class="bi bi-bookmark flex-shrink-0"></i>
                <span class="truncate">Peminjamanku</span>
            </a>
            <a href="<?= base_url('/reservasi') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                <i class="bi bi-calendar-check flex-shrink-0"></i>
                <span class="truncate">Reservasi Saya</span>
            </a>
            <a href="<?= base_url('/riwayat-denda') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                <i class="bi bi-exclamation-circle flex-shrink-0"></i>
                <span class="truncate">Riwayat Denda</span>
            </a>
            <a href="<?= base_url('/pengaturan') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                <i class="bi bi-gear flex-shrink-0"></i>
                <span class="truncate">Pengaturan</span>
            </a>
        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-gray-200 flex-shrink-0">
            <a href="<?= site_url('/logout') ?>" class="flex items-center justify-center gap-2 w-full bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-3 rounded-lg transition duration-200">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-auto bg-gray-50">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</body>
</html>