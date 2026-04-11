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
        <aside class="w-64 bg-white shadow-lg flex flex-col h-screen overflow-y-auto border-r border-gray-100 transition-all duration-300">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-100 flex-shrink-0 bg-gradient-to-br from-blue-50 to-white">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0 shadow-lg shadow-blue-200">
                        S
                    </div>
                    <div>
                        <h2 class="text-lg font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent whitespace-nowrap">Sipinjam</h2>
                        <p class="text-xs text-gray-500">Library System</p>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
                <?php $currentUri = uri_string(); ?>

                <a href="<?= base_url('/dashboard') ?>" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 <?= strpos($currentUri, 'dashboard') !== false ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 border-l-4 border-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' ?>">
                    <i class="bi bi-speedometer2 flex-shrink-0 text-lg transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="truncate">Dashboard</span>
                    <?= strpos($currentUri, 'dashboard') !== false ? '<i class="bi bi-check2 ml-auto text-blue-600"></i>' : '' ?>
                </a>

                <a href="<?= base_url('/katalog') ?>" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 <?= strpos($currentUri, 'katalog') !== false ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 border-l-4 border-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' ?>">
                    <i class="bi bi-library flex-shrink-0 text-lg transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="truncate">Katalog Buku</span>
                    <?= strpos($currentUri, 'katalog') !== false ? '<i class="bi bi-check2 ml-auto text-blue-600"></i>' : '' ?>
                </a>

                <a href="<?= base_url('/peminjamanku') ?>" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 <?= strpos($currentUri, 'peminjamanku') !== false ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 border-l-4 border-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' ?>">
                    <i class="bi bi-hand-thumbs-up flex-shrink-0 text-lg transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="truncate">Peminjamanku</span>
                    <?= strpos($currentUri, 'peminjamanku') !== false ? '<i class="bi bi-check2 ml-auto text-blue-600"></i>' : '' ?>
                </a>

                <a href="<?= base_url('/reservasi') ?>" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 <?= strpos($currentUri, 'reservasi') !== false ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 border-l-4 border-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' ?>">
                    <i class="bi bi-calendar2-check flex-shrink-0 text-lg transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="truncate">Reservasi Saya</span>
                    <?= strpos($currentUri, 'reservasi') !== false ? '<i class="bi bi-check2 ml-auto text-blue-600"></i>' : '' ?>
                </a>

                <a href="<?= base_url('/riwayat-denda') ?>" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 <?= strpos($currentUri, 'riwayat-denda') !== false ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 border-l-4 border-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' ?>">
                    <i class="bi bi-receipt flex-shrink-0 text-lg transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="truncate">Riwayat Denda</span>
                    <?= strpos($currentUri, 'riwayat-denda') !== false ? '<i class="bi bi-check2 ml-auto text-blue-600"></i>' : '' ?>
                </a>

                <a href="<?= base_url('/pengaturan') ?>" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 <?= strpos($currentUri, 'pengaturan') !== false ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 border-l-4 border-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' ?>">
                    <i class="bi bi-sliders flex-shrink-0 text-lg transition-transform duration-300 group-hover:scale-110"></i>
                    <span class="truncate">Pengaturan</span>
                    <?= strpos($currentUri, 'pengaturan') !== false ? '<i class="bi bi-check2 ml-auto text-blue-600"></i>' : '' ?>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-100 flex-shrink-0 bg-gray-50">
                <a href="<?= site_url('/logout') ?>" class="group flex items-center justify-center gap-2 w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold px-4 py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                    <i class="bi bi-box-arrow-left transition-transform duration-300 group-hover:-translate-x-1"></i>
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