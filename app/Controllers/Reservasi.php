<?php

namespace App\Controllers;

class Reservasi extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('Reservasi', [
            'user' => session()->get('mahasiswa'),
        ]);
    }
}
