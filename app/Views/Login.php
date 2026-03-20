<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
	<title>Login Mahasiswa</title>
</head>
<body class="min-h-screen bg-blue-50 p-6 md:p-10">
	<div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
		<section class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl p-8 text-white shadow-lg">
			<p class="inline-block bg-white/20 px-3 py-1 rounded-full text-sm">Portal Peminjaman</p>
			<h1 class="text-3xl font-bold mt-4">Login Mahasiswa</h1>
			<p class="mt-3 text-blue-100 leading-relaxed">Masuk dengan data mahasiswa untuk mengakses dashboard peminjaman buku digital.</p>

			<div class="mt-8">
				<p class="font-semibold mb-2">Akun Dummy untuk Testing:</p>
				<ul class="space-y-2 text-sm text-blue-50">
					<?php foreach ($dummyMahasiswa as $dummy): ?>
						<li class="bg-white/10 rounded-lg p-3">
							<?= esc($dummy['nama']) ?> | NIM: <?= esc($dummy['nim']) ?> | <?= esc($dummy['jurusan']) ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>

		<section class="bg-white rounded-2xl p-8 shadow-lg border border-blue-100">
			<h2 class="text-2xl font-bold text-slate-800">Masuk Sekarang</h2>
			<p class="text-slate-500 mt-1">Isi data mahasiswa kamu dengan benar.</p>

			<?php if (session()->getFlashdata('error')): ?>
				<div class="mt-4 rounded-lg bg-red-50 text-red-700 px-4 py-3 text-sm">
					<?= esc(session()->getFlashdata('error')) ?>
				</div>
			<?php endif; ?>

			<?php if (session()->getFlashdata('success')): ?>
				<div class="mt-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 text-sm">
					<?= esc(session()->getFlashdata('success')) ?>
				</div>
			<?php endif; ?>

			<form action="<?= site_url('/login') ?>" method="post" class="mt-6 space-y-5">
				<?= csrf_field() ?>

				<div>
					<label for="nama_mahasiswa" class="block text-sm font-medium text-slate-700">Nama Mahasiswa</label>
					<input
						id="nama_mahasiswa"
						name="nama_mahasiswa"
						type="text"
						value="<?= old('nama_mahasiswa') ?>"
						class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
						placeholder="Contoh: Agung Pratama"
						required
					>
				</div>

				<div>
					<label for="nim" class="block text-sm font-medium text-slate-700">NIM</label>
					<input
						id="nim"
						name="nim"
						type="text"
						value="<?= old('nim') ?>"
						class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
						placeholder="Contoh: 22011001"
						required
					>
				</div>

				<div>
					<label for="jurusan" class="block text-sm font-medium text-slate-700">Jurusan</label>
					<input
						id="jurusan"
						name="jurusan"
						type="text"
						value="<?= old('jurusan') ?>"
						class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
						placeholder="Contoh: Teknik Informatika"
						required
					>
				</div>

				<button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition">
					Login
				</button>
			</form>
		</section>
	</div>
</body>
</html>
