<?php

namespace App\Controllers;

class Katalog extends BaseController
{
	public function index()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
		}

		return view('KatalogBuku', [
			'user' => session()->get('mahasiswa'),
		]);
	}
}