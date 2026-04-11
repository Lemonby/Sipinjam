<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- FLASH MESSAGES -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-600 rounded-lg flex items-center gap-3">
            <i class="bi bi-check-circle text-green-600 text-xl"></i>
            <p class="text-green-700"><?= session()->getFlashdata('success') ?></p>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-600 rounded-lg flex items-center gap-3">
            <i class="bi bi-exclamation-circle text-red-600 text-xl"></i>
            <p class="text-red-700"><?= session()->getFlashdata('error') ?></p>
        </div>
    <?php endif; ?>

    <!-- HEADER -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Denda</h1>
                    <p class="text-blue-100 mt-2">Kelola denda keterlambatan peminjaman buku Anda.</p>
                </div>
                <i class="bi bi-cash-stack text-5xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- RINGKASAN DENDA -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-blue-500">
            <p class="text-gray-600 text-sm font-medium">Total Denda</p>
            <h3 class="text-4xl font-bold text-blue-600 mt-2">Rp <?= number_format($totalDenda + $totalBayar, 0, ',', '.') ?></h3>
            <p class="text-gray-500 text-xs mt-1">Hingga saat ini</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-red-500">
            <p class="text-gray-600 text-sm font-medium">Denda Menunggu</p>
            <h3 class="text-4xl font-bold text-red-600 mt-2">Rp <?= number_format($totalDenda, 0, ',', '.') ?></h3>
            <p class="text-gray-500 text-xs mt-1">Belum dibayar (<?= $countUnpaidFines ?> denda)</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-md border-l-4 border-green-500">
            <p class="text-gray-600 text-sm font-medium">Denda Dibayar</p>
            <h3 class="text-4xl font-bold text-green-600 mt-2">Rp <?= number_format($totalBayar, 0, ',', '.') ?></h3>
            <p class="text-gray-500 text-xs mt-1">Sudah diselesaikan</p>
        </div>
    </div>

    <!-- DAFTAR DENDA -->
    <div class="bg-white rounded-2xl p-6 shadow-md">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-800 mb-2 flex items-center gap-2">
                Daftar Denda
            </h2>
            <div class="h-1 w-12 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full"></div>
        </div>


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
                    <?php if (!empty($fines)): ?>
                        <?php foreach ($fines as $fine): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3 text-slate-800"><?= esc($fine['judul_buku']) ?></td>
                                <td class="px-4 py-3 text-gray-600"><?= date('d M Y', strtotime($fine['tanggal_kembali'])) ?></td>
                                <td class="px-4 py-3 text-gray-600">
                                    <?php 
                                        $diff = date_diff(date_create($fine['tanggal_kembali']), date_create(date('Y-m-d')));
                                        echo $diff->days > 0 ? $diff->days . ' hari' : '-';
                                    ?>
                                </td>
                                <td class="px-4 py-3 font-semibold text-red-600">Rp <?= number_format($fine['jumlahDenda'], 0, ',', '.') ?></td>
                                <td class="px-4 py-3">
                                    <?php if ($fine['status'] === 'belum dibayar'): ?>
                                        <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Belum Dibayar
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Sudah Dibayar
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <?php if ($fine['status'] === 'belum dibayar'): ?>
                                        <button 
                                            type="button"
                                            onclick="openPaymentModal(<?= $fine['id'] ?>, 'Rp <?= number_format($fine['jumlahDenda'], 0, ',', '.') ?>', '<?= esc($fine['judul_buku']) ?>')"
                                            class="text-blue-500 hover:text-blue-700 font-semibold text-sm hover:underline">
                                            Bayar
                                        </button>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-sm">Sudah Dibayar</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                                <i class="bi bi-check-circle text-green-500 text-4xl mb-2 block"></i>
                                <p class="mt-2">Tidak ada denda saat ini. Selamat!</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- PAYMENT MODAL -->
<div 
    id="paymentModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm opacity-0 invisible transition-all duration-300 flex items-center justify-center z-50"
>
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 transform scale-95 opacity-0 transition-all duration-300" style="animation: slideUp 0.3s ease-out forwards;">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-6 rounded-t-3xl flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold">Bayar Denda</h3>
                <p class="text-blue-100 text-sm mt-1">Upload bukti pembayaran Anda</p>
            </div>
            <button type="button" onclick="closePaymentModal()" class="text-white hover:bg-white/20 rounded-full p-2 transition-colors">
                <i class="bi bi-x text-2xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <form id="paymentForm" onsubmit="handlePaymentSubmit(event)" class="p-8">
            <?= csrf_field() ?>
            <input type="hidden" id="fineId" name="fineId">

            <!-- Book and Amount Info -->
            <div class="mb-6 p-4 bg-gray-100 rounded-xl">
                <p class="text-gray-600 text-sm">Biaya Denda</p>
                <p class="text-2xl font-bold text-red-600" id="fineAmount">Rp 0</p>
                <p class="text-gray-600 text-sm mt-2">Buku: <span id="bookTitle" class="font-semibold"></span></p>
            </div>

            <!-- File Upload -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-3 flex items-center gap-2">
                    <i class="bi bi-image text-blue-600"></i>
                    Bukti Pembayaran
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition-colors cursor-pointer" id="uploadArea">
                    <i class="bi bi-cloud-arrow-up text-3xl text-gray-400 block mb-2"></i>
                    <p class="text-gray-600 text-sm">Klik atau drag file foto</p>
                    <p class="text-gray-500 text-xs mt-1">JPG, PNG, atau PDF (Max. 5MB)</p>
                    <input 
                        type="file" 
                        id="buktiPembayaran" 
                        name="buktiPembayaran" 
                        class="hidden"
                        accept=".jpg,.jpeg,.png,.pdf"
                        onchange="handleFileSelect(event)"
                        required
                    >
                </div>

                <!-- File Preview -->
                <div id="filePreview" class="mt-4 hidden">
                    <p class="text-gray-700 font-semibold text-sm mb-2">File Dipilih:</p>
                    <div class="flex items-center gap-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                        <i class="bi bi-check-circle text-green-600 text-xl"></i>
                        <span class="text-sm text-gray-700" id="fileName"></span>
                        <button 
                            type="button"
                            onclick="clearFileSelection()"
                            class="ml-auto text-red-500 hover:text-red-700 text-lg"
                        >
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Important Note -->
            <div class="mb-6 p-3 bg-amber-50 border border-amber-200 rounded-lg">
                <p class="text-amber-800 text-xs flex items-start gap-2">
                    <i class="bi bi-exclamation-circle-fill text-amber-600 flex-shrink-0 mt-0.5"></i>
                    <span>Pastikan bukti pembayaran jelas dan mencantumkan jumlah transfer yang sesuai dengan denda.</span>
                </p>
            </div>

            <!-- Modal Footer -->
            <div class="flex gap-3">
                <button 
                    type="button"
                    onclick="closePaymentModal()"
                    class="flex-1 px-6 py-3 text-gray-700 font-semibold border-2 border-gray-300 rounded-xl hover:bg-gray-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    type="submit"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all flex items-center justify-center gap-2"
                >
                    <i class="bi bi-check-circle"></i>
                    <span>Bayar Sekarang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CSS Animation -->
<style>
    @keyframes slideUp {
        from {
            transform: scale(0.95) translateY(20px);
            opacity: 0;
        }
        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }

    #paymentModal.show {
        opacity: 1;
        visibility: visible;
    }

    #paymentModal .animate-slideup {
        animation: slideUp 0.3s ease-out forwards;
    }
</style>

<!-- JavaScript Functions -->
<script>
    function openPaymentModal(fineId, amount, bookTitle) {
        document.getElementById('fineId').value = fineId;
        document.getElementById('fineAmount').textContent = amount;
        document.getElementById('bookTitle').textContent = bookTitle;
        
        const modal = document.getElementById('paymentModal');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
        
        // Clear previous file selection
        clearFileSelection();
        document.getElementById('paymentForm').reset();
    }

    function closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('paymentModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closePaymentModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePaymentModal();
        }
    });

    // File upload handling
    function handleFileSelect(event) {
        const file = event.target.files[0];
        if (file) {
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            
            fileName.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            preview.classList.remove('hidden');
        }
    }

    function clearFileSelection() {
        document.getElementById('buktiPembayaran').value = '';
        document.getElementById('filePreview').classList.add('hidden');
    }

    // Handle drag and drop
    const uploadArea = document.getElementById('uploadArea');
    uploadArea?.addEventListener('click', () => {
        document.getElementById('buktiPembayaran').click();
    });

    uploadArea?.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('border-blue-400', 'bg-blue-50');
    });

    uploadArea?.addEventListener('dragleave', () => {
        uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
    });

    uploadArea?.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('buktiPembayaran').files = files;
            handleFileSelect({ target: { files: files } });
        }
    });

    // Handle form submission
    function handlePaymentSubmit(event) {
        event.preventDefault();
        
        const fineId = document.getElementById('fineId').value;
        const buktiFile = document.getElementById('buktiPembayaran').files[0];
        
        if (!fineId) {
            alert('ID denda tidak valid');
            return;
        }

        if (!buktiFile) {
            alert('Silakan pilih file bukti pembayaran');
            return;
        }

        // Create FormData for multipart upload
        const formData = new FormData();
        formData.append('buktiPembayaran', buktiFile);
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

        // Show loading state
        const submitBtn = document.querySelector('#paymentForm button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split animate-spin"></i> Memproses...';

        // Submit via AJAX
        fetch('<?= base_url('/denda/pay-with-proof') ?>/' + fineId, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            // Redirect will be handled by server, but we'll close modal and show message
            closePaymentModal();
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
        });
    }
</script>

<?= $this->endSection() ?>
