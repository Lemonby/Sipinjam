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

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span><?= esc(session()->getFlashdata('success')) ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
        <?php endif; ?>

        <!-- Tabel Reservasi -->
        <div class="overflow-x-auto">
            <?php if (empty($reservations)): ?>
                <div class="text-center py-12">
                    <i class="bi bi-inbox text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 mt-2">Belum ada reservasi buku.</p>
                    <a href="<?= base_url('/katalog') ?>" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Lihat Katalog Buku
                    </a>
                </div>
            <?php else: ?>
                <table class="w-full">
                    <thead class="bg-gray-100 border-b-2 border-gray-300">
                        <tr>
                            <th class="px-4 py-3 text-left text-slate-800 font-semibold">Judul Buku</th>
                            <th class="px-4 py-3 text-left text-slate-800 font-semibold">Penulis</th>
                            <th class="px-4 py-3 text-left text-slate-800 font-semibold">Tanggal Reservasi</th>
                            <th class="px-4 py-3 text-left text-slate-800 font-semibold">Antrian Ke</th>
                            <th class="px-4 py-3 text-left text-slate-800 font-semibold">Status</th>
                            <th class="px-4 py-3 text-center text-slate-800 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3 text-slate-800 font-medium"><?= esc($reservation['judul']) ?></td>
                                <td class="px-4 py-3 text-gray-600"><?= esc($reservation['penulis']) ?></td>
                                <td class="px-4 py-3 text-gray-600"><?= date('d M Y', strtotime($reservation['tanggalReservasi'])) ?></td>
                                <td class="px-4 py-3 text-gray-600">
                                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        #<?= $reservation['antrianKe'] ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <?php 
                                        $statusClass = '';
                                        $statusText = '';
                                        
                                        switch($reservation['status']) {
                                            case 'menunggu':
                                                $statusClass = 'bg-yellow-100 text-yellow-700';
                                                $statusText = 'Menunggu';
                                                break;
                                            case 'diproses':
                                                $statusClass = 'bg-blue-100 text-blue-700';
                                                $statusText = 'Diproses';
                                                break;
                                            case 'selesai':
                                                $statusClass = 'bg-green-100 text-green-700';
                                                $statusText = 'Selesai';
                                                break;
                                            case 'dibatalkan':
                                                $statusClass = 'bg-red-100 text-red-700';
                                                $statusText = 'Dibatalkan';
                                                break;
                                            default:
                                                $statusClass = 'bg-gray-100 text-gray-700';
                                                $statusText = ucfirst($reservation['status']);
                                        }
                                    ?>
                                    <span class="inline-block <?= $statusClass ?> px-3 py-1 rounded-full text-xs font-semibold">
                                        <?= $statusText ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <?php if ($reservation['status'] === 'menunggu' || $reservation['status'] === 'diproses'): ?>
                                        <button type="button" onclick="openCancelModal(<?= $reservation['id'] ?>)" class="text-red-500 hover:text-red-700 font-semibold text-sm transition-colors">
                                            <i class="bi bi-trash"></i> Batalkan
                                        </button>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-sm">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODAL KONFIRMASI PEMBATALAN -->
<div id="cancelModal" class="hidden fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 transform transition-transform duration-300 scale-100">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-4">
            <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="bi bi-exclamation-circle text-red-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-900">Batalkan Reservasi?</h3>
            </div>
        </div>

        <!-- Content -->
        <p class="text-gray-600 text-sm mb-6">
            Anda yakin ingin membatalkan reservasi ini? Tindakan ini tidak dapat dibatalkan dan Anda akan kehilangan nomor antrian.
        </p>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="button" onclick="closeCancelModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2.5 rounded-lg transition">
                <i class="bi bi-x-circle mr-2"></i>Batal
            </button>
            <form id="cancelForm" method="POST" class="flex-1">
                <?= csrf_field() ?>
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 rounded-lg transition flex items-center justify-center gap-2">
                    <i class="bi bi-check-circle"></i>Batalkan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript untuk Modal -->
<script>
    const cancelModal = document.getElementById('cancelModal');
    const cancelForm = document.getElementById('cancelForm');

    function openCancelModal(reservasiId) {
        // Set form action
        cancelForm.action = `<?= base_url('/reservasi/cancel/') ?>${reservasiId}`;
        
        // Show modal dengan animation
        cancelModal.classList.remove('hidden');
        cancelModal.classList.add('fade-in');
    }

    function closeCancelModal() {
        // Hide modal dengan smooth transition
        cancelModal.classList.add('hidden');
        cancelModal.classList.remove('fade-in');
    }

    // Close modal when clicking outside
    cancelModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCancelModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !cancelModal.classList.contains('hidden')) {
            closeCancelModal();
        }
    });
</script>

<style>
    .fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    #cancelModal:not(.hidden) > div {
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<?= $this->endSection() ?>
