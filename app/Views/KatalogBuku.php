<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<!-- Search & Filter Bar -->
<div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
    <input type="text" name="search" id="search" placeholder="Cari buku..." class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
    <input type="text" name="filter" id="filter" placeholder="Filter..." class="ml-4 rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
</div>

<!-- Book Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 p-6">
    <!-- Contoh Kartu Buku -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>

    <!-- Tambahkan kartu buku lainnya di sini -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>

    <!-- Tambahkan kartu buku lainnya di sini -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="<?= base_url('images/book-cover-placeholder.png') ?>" alt="Cover Buku" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-bold text-slate-800">Judul Buku</h3>
            <p class="text-sm text-slate-500 mt-1">Penulis: Nama Penulis</p>
            <p class="text-sm text-slate-500 mt-1">Tahun Terbit: 2020</p>
            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">Pinjam</button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>