<?php

namespace App\Controllers;

class Denda extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('Denda', [
            'user' => session()->get('mahasiswa'),
        ]);
    }
}
