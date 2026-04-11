<?php

namespace App\Controllers;

class Reservasi extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $reservationModel = new \App\Models\ReservationModel();
        $idUser = session()->get('mahasiswa')['id'];
        $reservations = $reservationModel->getReservationsByUser($idUser);

        return view('Reservasi', [
            'user' => session()->get('mahasiswa'),
            'reservations' => $reservations,
        ]);
    }

    /**
     * Create new reservation
     */
    public function reserve($idBuku)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $reservationModel = new \App\Models\ReservationModel();
        $booksModel = new \App\Models\BooksModel();
        $idUser = session()->get('mahasiswa')['id'];

        // Check if book exists
        $book = $booksModel->getBookById($idBuku);
        if (!$book) {
            return redirect()->to('/katalog')->with('error', 'Buku tidak ditemukan.');
        }

        // Check if user already reserved this book
        if ($reservationModel->isAlreadyReserved($idUser, $idBuku)) {
            return redirect()->to('/katalog')->with('error', 'Anda sudah melakukan reservasi untuk buku ini.');
        }

        // Check if book is available
        if ($book['statusTersedia'] > 0) {
            return redirect()->to('/katalog')->with('error', 'Buku ini masih tersedia, tidak perlu di-reserve.');
        }

        // Create reservation
        if ($reservationModel->createReservation($idUser, $idBuku)) {
            return redirect()->to('/reservasi')->with('success', 'Reservasi berhasil! Nomor antrian Anda akan ditampilkan.');
        } else {
            return redirect()->to('/katalog')->with('error', 'Reservasi gagal. Silakan coba lagi.');
        }
    }

    /**
     * Cancel reservation
     */
    public function cancel($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        try {
            $reservationModel = new \App\Models\ReservationModel();
            $idUser = session()->get('mahasiswa')['id'];

            // Check if reservation exists and belongs to user
            $reservation = $reservationModel->getReservationById($id, $idUser);
            if (!$reservation) {
                return redirect()->to('/reservasi')->with('error', 'Reservasi tidak ditemukan.');
            }

            // Cancel reservation
            $result = $reservationModel->cancelReservation($id, $idUser);
            
            if ($result) {
                return redirect()->to('/reservasi')->with('success', 'Reservasi berhasil dibatalkan.');
            } else {
                return redirect()->to('/reservasi')->with('error', 'Gagal membatalkan reservasi.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/reservasi')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
