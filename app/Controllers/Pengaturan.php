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

    public function updateProfile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new \App\Models\UserModel();

        $nama = $this->request->getPost('nama');
        $nim = $this->request->getPost('nim');
        $jurusan = $this->request->getPost('jurusan');
        $email = $this->request->getPost('email');
        $telp = $this->request->getPost('telp');

        $data = [
            'nama' => $nama,
            'nim' => $nim,
            'jurusan' => $jurusan,
            'email' => $email,
            'telp' => $telp
        ];

        $userModel->update(session()->get('mahasiswa')['id'], $data);

        // Update session data
        session()->set('mahasiswa', array_merge(session()->get('mahasiswa'), $data));

        return redirect()->to('/pengaturan')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userModel = new \App\Models\UserModel();

        
        $nama = $this->request->getPost('nama');
        $nim = $this->request->getPost('nim');
        $jurusan = $this->request->getPost('jurusan');
        $email = $this->request->getPost('email');
        $telp = $this->request->getPost('telp');
        $passLama = $this->request->getPost('passwordLama');    
        $passBaru = $this->request->getPost('passwordBaru');
        $konfirmasiPass = $this->request->getPost('konfirmasiPassword');

        if ($passLama || $passBaru || $konfirmasiPass) {
            if (!$passLama || !$passBaru || !$konfirmasiPass) {
                return redirect()->to('/pengaturan')->with('error', 'Semua field password harus diisi untuk mengubah password.');
            }

            if (!password_verify($passLama, session()->get('mahasiswa')['password'])) {
                return redirect()->to('/pengaturan')->with('error', 'Password lama tidak benar.');
            }

            if ($passBaru !== $konfirmasiPass) {
                return redirect()->to('/pengaturan')->with('error', 'Konfirmasi password baru tidak cocok.');
            }

            $data['password'] = password_hash($passBaru, PASSWORD_DEFAULT);
        }

        $data = [
            'nama' => $nama,
            'nim' => $nim,
            'jurusan' => $jurusan,
            'email' => $email,
            'telp' => $telp
        ];

        $userModel->update(session()->get('mahasiswa')['id'], $data);

        // Update session data
        session()->set('mahasiswa', array_merge(session()->get('mahasiswa'), $data));

        return redirect()->to('/pengaturan')->with('success', 'Password berhasil diperbarui.');
    }
}
