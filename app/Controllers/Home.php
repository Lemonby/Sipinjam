<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $user = session()->get('mahasiswa');
        return view('LandingPage', [
            'user' => $user,
        ]);
    }
}
