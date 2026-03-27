<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <h1 class="text-3xl font-bold">Perpanjang Peminjaman</h1>
            <p class="text-blue-100 mt-2">Perpanjang waktu peminjaman buku Anda.</p>
        </div>
    </div>

    <!-- ALERT MESSAGES -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- FORM PERPANJANGAN -->
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
                        <p class="text-gray-600 font-semibold">TANGGAL KEMBALI SEBELUMNYA</p>
                        <p class="text-red-600 font-bold"><?= date('d M Y', strtotime($tanggalKembaliLama)) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM PERPANJANGAN -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-6 shadow-md">
                <h2 class="text-xl font-bold text-slate-800 mb-6">Informasi Perpanjangan</h2>

                <form action="<?= base_url('/peminjaman/proses-perpanjang') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>
                    <input type="hidden" name="idBookCopy" value="<?= $idBookCopy ?>">

                    <!-- Status Sebelumnya -->
                    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                        <p class="text-sm text-gray-600 font-semibold mb-2">STATUS PEMINJAMAN SEBELUMNYA</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-lg font-bold text-slate-800">Kembali pada:</p>
                                <p class="text-gray-600"><?= date('d M Y', strtotime($tanggalKembaliLama)) ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600 font-semibold">DURASI</p>
                                <p class="text-2xl font-bold text-blue-600">
                                    <?= floor((strtotime($tanggalKembaliLama) - strtotime($peminjaman['tanggalPinjam'])) / (60 * 60 * 24)) ?> hari
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Kembali Baru -->
                    <div>
                        <label for="tanggalKembaliBaru" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kembali Baru <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggalKembaliBaru" name="tanggalKembaliBaru" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" required>
                        <p class="text-xs text-gray-500 mt-1">Default 7 hari perpanjangan: <?= date('d M Y', strtotime($tanggalKembaliBaru)) ?></p>
                    </div>

                    <!-- Durasi Perpanjangan (Read-only) -->
                    <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                        <label for="durasiPerpanjangan" class="block text-sm font-semibold text-slate-700 mb-2">Durasi Perpanjangan Tambahan</label>
                        <div class="text-3xl font-bold text-green-600" id="durasiPerpanjangan">7 hari</div>
                        <p class="text-xs text-gray-600 mt-2">Dari <?= date('d M Y', strtotime($tanggalKembaliLama)) ?> hingga tanggal yang Anda pilih</p>
                    </div>

                    <!-- Info Penting -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <p class="text-sm text-yellow-800">
                            <span class="font-semibold">⚠️ Penting:</span> Pastikan Anda mengembalikan buku sesuai tanggal baru yang ditentukan. Keterlambatan akan dikenakan denda.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition">
                            <i class="bi bi-check-circle mr-2"></i>Konfirmasi Perpanjangan
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

<!-- JavaScript untuk menghitung durasi perpanjangan -->
<script>
    const tanggalKembaliLama = new Date('<?= $tanggalKembaliLama ?>');
    const tanggalKembaliBaruInput = document.getElementById('tanggalKembaliBaru');
    const durasiPerpanjanganDiv = document.getElementById('durasiPerpanjangan');

    function hitungDurasiPerpanjangan() {
        const tanggalKembaliBaru = new Date(tanggalKembaliBaruInput.value);

        if (tanggalKembaliBaruInput.value) {
            const selisih = Math.floor((tanggalKembaliBaru - tanggalKembaliLama) / (1000 * 60 * 60 * 24));
            
            if (selisih > 0) {
                durasiPerpanjanganDiv.textContent = `${selisih} hari`;
                durasiPerpanjanganDiv.classList.remove('text-red-600');
                durasiPerpanjanganDiv.classList.add('text-green-600');
            } else if (selisih === 0) {
                durasiPerpanjanganDiv.textContent = 'Tanggal sama (tidak ada perpanjangan)';
                durasiPerpanjanganDiv.classList.remove('text-green-600');
                durasiPerpanjanganDiv.classList.add('text-red-600');
            } else {
                durasiPerpanjanganDiv.textContent = 'Tanggal tidak valid (lebih awal)';
                durasiPerpanjanganDiv.classList.remove('text-green-600');
                durasiPerpanjanganDiv.classList.add('text-red-600');
            }
        }
    }

    tanggalKembaliBaruInput.addEventListener('change', hitungDurasiPerpanjangan);
    
    // Hitung saat halaman load
    hitungDurasiPerpanjangan();
</script>

<?= $this->endSection() ?>
