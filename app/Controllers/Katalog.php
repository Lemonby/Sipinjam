<?php

namespace App\Controllers;

class Katalog extends BaseController
{

	private Array $Buku = [
		[
			'id' => 1,
			'judul' => 'Pemrograman Web dengan CodeIgniter',
			'penulis' => 'John Doe',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+1',
			'status' => 'tersedia',
			'tanggal_kembali' => '3 hari lagi',
		],
		[
			'id' => 2,
			'judul' => 'Belajar PHP untuk Pemula',
			'penulis' => 'Jane Smith',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+2',
			'status' => 'tidak tersedia',
			'tanggal_kembali' => '3 hari yang lalu',
		],
		[
			'id' => 3,
			'judul' => 'Framework Laravel untuk Semua',
			'penulis' => 'Alice Johnson',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+3',
			'status' => 'tersedia',
			'tanggal_kembali' => '5 hari lagi',
		],
		[
			'id' => 4,
			'judul' => 'Membangun Aplikasi dengan Vue.js',
			'penulis' => 'Bob Brown',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+4',
			'status' => 'tersedia',
			'tanggal_kembali' => '7 hari lagi',
		],
		[
			'id' => 5,
			'judul' => 'Belajar JavaScript dengan Mudah',
			'penulis' => 'Charlie Davis',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+5',
			'status' => 'tidak tersedia',
			'tanggal_kembali' => '1 hari yang lalu',
		],
		[
			'id' => 6,
			'judul' => 'Desain UI/UX untuk Pemula',
			'penulis' => 'Diana Evans',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+6',
			'status' => 'tersedia',
			'tanggal_kembali' => '10 hari lagi',
		],
		[
			'id' => 7,
			'judul' => 'Belajar Python untuk Semua',
			'penulis' => 'Eve Foster',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+7',
			'status' => 'tersedia',
			'tanggal_kembali' => '2 hari lagi',
		],
		[
			'id' => 8,
			'judul' => 'Membangun API dengan Node.js',
			'penulis' => 'Frank Green',
			'cover' => 'https://via.placeholder.com/100x150?text=Book+8',
			'status' => 'tidak tersedia',
			'tanggal_kembali' => '4 hari yang lalu',
		],
	];
	
	public function index()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
		}

		return view('KatalogBuku', [
			'user' => session()->get('mahasiswa'),
			'DummyBuku' => $this->Buku
		]);
	}
}