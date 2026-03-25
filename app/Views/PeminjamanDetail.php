<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER -->
    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl p-8 mb-8 shadow-lg">
        <h1 class="text-3xl font-bold">Peminjaman Buku</h1>
        <p class="text-blue-100 mt-2">Lengkapi data untuk peminjaman buku Anda.</p>
    </div>

    <!-- ALERT MESSAGES -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- FORM PEMINJAMAN -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- DETAIL BUKU -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 shadow-md sticky top-8">
                <h2 class="text-xl font-bold text-slate-800 mb-4">Detail Buku</h2>
                
                <!-- Cover Buku -->
                <img src="<?= $buku['cover'] ?>" alt="<?= $buku['judul'] ?>" class="w-full h-64 object-cover rounded-lg mb-4">
                
                <!-- Info Buku -->
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">JUDUL</p>
                        <p class="text-lg font-bold text-slate-800"><?= $buku['judul'] ?></p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">PENULIS</p>
                        <p class="text-slate-700"><?= $buku['penulis'] ?></p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">STATUS</p>
                        <p class="text-sm font-medium text-green-600 bg-green-100 rounded px-2 py-1 inline-block">Tersedia</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM PEMINJAMAN -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <h2 class="text-xl font-bold text-slate-800 mb-6">Informasi Peminjaman</h2>

                <form action="<?= base_url('/peminjaman/proses') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_buku" value="<?= $buku['id'] ?>">

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Mulai Peminjaman <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="<?= $tanggal_mulai ?>" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" required>
                        <p class="text-xs text-gray-500 mt-1">Default hari ini: <?= date('d M Y', strtotime($tanggal_mulai)) ?></p>
                    </div>

                    <!-- Tanggal Kembali -->
                    <div>
                        <label for="tanggal_kembali" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kembali <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="<?= $tanggal_kembali ?>" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" required>
                        <p class="text-xs text-gray-500 mt-1">Default 7 hari: <?= date('d M Y', strtotime($tanggal_kembali)) ?></p>
                    </div>

                    <!-- Lama Peminjaman (Read-only) -->
                    <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                        <label for="lama_peminjaman" class="block text-sm font-semibold text-slate-700 mb-2">Lama Peminjaman</label>
                        <div class="text-3xl font-bold text-blue-600" id="lama_peminjaman">7 hari</div>
                        <p class="text-xs text-gray-600 mt-2">Durasi peminjaman akan dihitung otomatis</p>
                    </div>

                    <!-- Catatan (Opsional) -->
                    <div>
                        <label for="catatan" class="block text-sm font-semibold text-slate-700 mb-2">Catatan (Opsional)</label>
                        <textarea id="catatan" name="catatan" rows="4" placeholder="Masukkan catatan jika ada..." class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Contoh: kondisi buku, kebutuhan khusus, dll</p>
                    </div>

                    <!-- Info Penting -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <p class="text-sm text-yellow-800">
                            <span class="font-semibold">⚠️ Penting:</span> Pastikan Anda mengembalikan buku tepat waktu. Keterlambatan pengembalian akan dikenakan denda sesuai dengan kebijakan perpustakaan.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition">
                            <i class="bi bi-check-circle mr-2"></i>Konfirmasi Peminjaman
                        </button>
                        <a href="<?= base_url('/katalog') ?>" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 rounded-lg transition text-center">
                            <i class="bi bi-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk menghitung lama peminjaman -->
<script>
    const tanggalMulaiInput = document.getElementById('tanggal_mulai');
    const tanggalKembaliInput = document.getElementById('tanggal_kembali');
    const lamaPeminjamanDiv = document.getElementById('lama_peminjaman');

    function hitungLamaPeminjaman() {
        const tanggalMulai = new Date(tanggalMulaiInput.value);
        const tanggalKembali = new Date(tanggalKembaliInput.value);

        if (tanggalMulai && tanggalKembali) {
            const selisih = Math.floor((tanggalKembali - tanggalMulai) / (1000 * 60 * 60 * 24));
            
            if (selisih > 0) {
                lamaPeminjamanDiv.textContent = `${selisih} hari`;
            } else if (selisih === 0) {
                lamaPeminjamanDiv.textContent = 'Hari yang sama';
                lamaPeminjamanDiv.classList.remove('text-blue-600');
                lamaPeminjamanDiv.classList.add('text-red-600');
            } else {
                lamaPeminjamanDiv.textContent = 'Tanggal tidak valid';
                lamaPeminjamanDiv.classList.remove('text-blue-600');
                lamaPeminjamanDiv.classList.add('text-red-600');
            }
        }
    }

    tanggalMulaiInput.addEventListener('change', hitungLamaPeminjaman);
    tanggalKembaliInput.addEventListener('change', hitungLamaPeminjaman);

    // Hitung saat halaman load
    hitungLamaPeminjaman();
</script>

<?= $this->endSection() ?>
