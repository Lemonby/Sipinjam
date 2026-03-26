<?php

namespace App\Controllers;

class Auth extends BaseController
{
    /**
     * Dummy data mahasiswa untuk simulasi login tanpa database.
     */

    public function login(): string
    {
        $authModel = new \App\Models\AuthModel();
        $mahasiswa = $authModel->getAllUsers();
        return view('Login', [
            'dummyMahasiswa' => $mahasiswa,
        ]);
    }

    public function authenticate()
    {

        $authModel = new \App\Models\AuthModel();
        $allMahasiswa = $authModel->getAllUsers();
        
        $nama = trim((string) $this->request->getPost('namaMahasiswa'));
        $nim = trim((string) $this->request->getPost('nim'));
        $jurusan = trim((string) $this->request->getPost('jurusan'));

        if ($nama === '' || $nim === '' || $jurusan === '') {
            return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi.');
        }

        foreach ($allMahasiswa as $mahasiswa) {
            $isMatch = strtolower($mahasiswa['nama']) === strtolower($nama)
                && $mahasiswa['nim'] === $nim
                && strtolower($mahasiswa['jurusan']) === strtolower($jurusan);

            if ($isMatch) {
                session()->set([
                    'isLoggedIn' => true,
                    'mahasiswa' => $mahasiswa,
                ]);

                return redirect()->to('/dashboard');
            }
        }

        return redirect()->back()->withInput()->with('error', 'Data tidak cocok dengan akun dummy yang tersedia.');
    }

    public function dashboard(): string
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('Dashboard', [
            'user' => session()->get('mahasiswa'),
        ]);
    }

    public function logout()
    {
        session()->destroy();
    
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
}
