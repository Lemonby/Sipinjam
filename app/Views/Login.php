<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
	<title>Login Mahasiswa</title>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 p-6 md:p-10 flex items-center justify-center">
	<div class="w-full max-w-lg">
		<section class="bg-white rounded-2xl p-10 shadow-2xl border border-gray-100">
			<!-- Header dengan deskripsi -->
			<div class="flex items-center justify-center w-12 h-12 bg-blue-50 rounded-xl mb-4 mx-auto">
				<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 3 9.825 3 14.25c0 5.079 3.855 9.296 9 9.296s9-4.217 9-9.296c0-4.425-3.5-7.997-9-8.997z"></path>
				</svg>
			</div>
			<h1 class="text-3xl font-bold text-center text-gray-900">Sipinjam</h1>
			<p class="text-center text-gray-600 mt-1 text-sm">Sistem Manajemen Peminjaman Buku</p>
			
			<!-- <div class="mt-6 space-y-3 pb-6 border-b border-gray-200">
				<div class="flex items-start space-x-3">
					<svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
					</svg>
					<div>
						<p class="font-semibold text-gray-900 text-sm">Akses Mudah</p>
						<p class="text-gray-600 text-xs">Login dengan data mahasiswa Anda</p>
					</div>
				</div>
				<div class="flex items-start space-x-3">
					<svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
					</svg>
					<div>
						<p class="font-semibold text-gray-900 text-sm">Kelola Peminjaman</p>
						<p class="text-gray-600 text-xs">Lihat dan perpanjang buku pinjaman</p>
					</div>
				</div>
				<div class="flex items-start space-x-3">
					<svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
					</svg>
					<div>
						<p class="font-semibold text-gray-900 text-sm">Transparan</p>
						<p class="text-gray-600 text-xs">Informasi denda dan pengembalian jelas</p>
					</div>
				</div>
			</div> -->

			<!-- Form Login -->
			<!-- <h2 class="text-2xl font-bold text-gray-900 mt-6">Masuk Sekarang</h2>
			<p class="text-gray-600 mt-1 text-sm">Masukkan data mahasiswa Anda untuk melanjutkan</p> -->

			<?php if (session()->getFlashdata('error')): ?>
				<div class="mt-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm flex items-start">
					<svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
					</svg>
					<span><?= esc(session()->getFlashdata('error')) ?></span>
				</div>
			<?php endif; ?>

			<?php if (session()->getFlashdata('success')): ?>
				<div class="mt-4 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm flex items-start">
					<svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
					</svg>
					<span><?= esc(session()->getFlashdata('success')) ?></span>
				</div>
			<?php endif; ?>

			<form action="<?= site_url('/login') ?>" method="post" class="mt-6 space-y-4">
				<?= csrf_field() ?>

				<div>
					<label for="namaMahasiswa" class="block text-sm font-semibold text-gray-800">Nama Mahasiswa</label>
					<input
						id="namaMahasiswa"
						name="namaMahasiswa"
						type="text"
						value="<?= old('namaMahasiswa') ?>"
						class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
						placeholder="Masukkan nama Anda"
						required
					>
				</div>

				<div>
					<label for="nim" class="block text-sm font-semibold text-gray-800">NIM</label>
					<input
						id="nim"
						name="nim"
						type="text"
						value="<?= old('nim') ?>"
						class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
						placeholder="Nomor Induk Mahasiswa"
						required
					>
				</div>

				<div>
					<label for="jurusan" class="block text-sm font-semibold text-gray-800">Jurusan</label>
					<input
						id="jurusan"
						name="jurusan"
						type="text"
						value="<?= old('jurusan') ?>"
						class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
						placeholder="Program Studi Anda"
						required
					>
				</div>

				<button type="submit" class="w-full mt-6 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold py-3 rounded-lg transition transform hover:scale-105 shadow-lg">
					Masuk ke Dashboard
				</button>
			</form>

			<p class="mt-6 text-center text-gray-600 text-sm">
				Hubungi administrator jika Anda memiliki masalah login
			</p>
		</section>
	</div>
</body>
</html>
