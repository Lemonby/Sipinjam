<?= $this->extend('layout/PageLayoutSipinjam') ?>

<?= $this->section('content') ?>

<div class="p-8">
    <!-- HEADER -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">Pengaturan</h1>
                    <p class="text-blue-100 mt-2">Kelola pengaturan akun Anda.</p>
                </div>
                <i class="bi bi-gear-wide text-5xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- ALERT MESSAGES -->
    <?php if (session()->get('success')): ?>
            <div class="bg-green-50 border-2 border-green-400 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center gap-3 shadow-md animate-pulse">
                <i class="bi bi-check-circle-fill text-2xl text-green-600"></i>
                <div>
                    <p class="font-semibold">Berhasil!</p>
                    <p class="text-sm"><?= session()->get('success') ?></p>
                </div>
            </div>
    <?php elseif (session()->get('error')): ?>
        <div class="bg-red-50 border-2 border-red-400 text-red-800 px-6 py-4 rounded-xl mb-6 flex items-center gap-3 shadow-md animate-pulse">
            <i class="bi bi-exclamation-triangle-fill text-2xl text-red-600"></i>
            <div>
                <p class="font-semibold">Error!</p>
                <p class="text-sm"><?= session()->get('error') ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- PENGATURAN AKUN -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- MAIN CONTENT -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Profil -->
            <form action="<?= base_url('/pengaturan/update-profil') ?>" method="POST">
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">Informasi Profil</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" value="<?= esc($user['nama']) ?>" name="nama" class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">NIM</label>
                            <input type="text" value="<?= esc($user['nim']) ?>" name="nim" class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Jurusan</label>
                            <input type="text" value="<?= esc($user['jurusan']) ?>" name="jurusan" class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                            <input type="email" value="<?= esc($user['email']) ?>" name="email" class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">No. Handphone</label>
                            <input type="tel" value="<?= esc($user['telp']) ?>" name="telp" class="w-full rounded-lg border border-gray-300 px-4 py-2 bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>

            <!-- Keamanan -->
            <form action="<?= base_url('pengaturan/update-password') ?>" method="post">
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">Keamanan</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Password Lama</label>
                            <input type="password" name="passwordLama" placeholder="masukkan password lama" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
                            <input type="password" name="passwordBaru" placeholder="masukkan password baru" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasiPassword" placeholder="konfirmasi password baru" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition transition-duration-200">
                        </div>

                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition">
                            Ubah Password
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- SIDEBAR -->
        <div class="lg:col-span-1">
            <!-- Info Box -->
            <div class="bg-blue-50 rounded-2xl p-6 border border-blue-200">
                <h3 class="font-bold text-slate-800 mb-4">
                    <i class="bi bi-info-circle text-blue-500 mr-2"></i>
                    Informasi Penting
                </h3>
                <ul class="space-y-3 text-sm text-slate-700">
                    <li>
                        <i class="bi bi-check-circle text-green-500 mr-2"></i>
                        Perubahan data profil akan langsung tersimpan
                    </li>
                    <li>
                        <i class="bi bi-check-circle text-green-500 mr-2"></i>
                        Password minimal 8 karakter
                    </li>
                    <li>
                        <i class="bi bi-check-circle text-green-500 mr-2"></i>
                        Gunakan password yang kuat
                    </li>
                </ul>
            </div>

            <!-- Notifikasi -->
            <div class="bg-white rounded-2xl p-6 shadow-md mt-6">
                <h3 class="font-bold text-slate-800 mb-4">Preferensi Notifikasi</h3>
                
                <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded border-gray-300">
                        <span class="text-sm text-slate-700">Email Notifikasi</span>
                    </label>
                    
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded border-gray-300">
                        <span class="text-sm text-slate-700">Pengingat Peminjaman</span>
                    </label>
                    
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 rounded border-gray-300">
                        <span class="text-sm text-slate-700">Update Katalog Baru</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
