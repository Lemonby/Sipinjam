<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $dashboardModel = new \App\Models\DashboardModel();
        $user = $dashboardModel->getUserByNim();
        $dataUser = $dashboardModel->getDataUser();


        return view('Dashboard', [
            'user' => $user,
            'dataUser' => $dataUser,
        ]);
    }

    public function getDataUser()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $dashboardModel = new \App\Models\DashboardModel();
        $user = $dashboardModel->getUserByNim();

        return $this->response->setJSON($user);
    }


}