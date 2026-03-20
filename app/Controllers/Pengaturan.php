<?php

namespace App\Controllers;

class Pengaturan extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('Pengaturan', [
            'user' => session()->get('mahasiswa'),
        ]);
    }
}
