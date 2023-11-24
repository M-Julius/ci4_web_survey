<?php

namespace App\Controllers;

use App\Models\MarketingModel;
use CodeIgniter\Controller;

class Marketing extends Controller
{
    public function index()
    {
        $marketingModel = new MarketingModel();
        $data['marketing'] = $marketingModel->findAll();

        return view('marketing/index', $data);
    }

    public function store()
    {
        $id = $this->request->getPost('id');
        $marketingModel = new MarketingModel();

        $data = [
            'nama_marketing' => $this->request->getPost('nama_marketing'),
            'alamat_marketing' => $this->request->getPost('alamat_marketing'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email')
        ];

        if ($id != null) {
            $marketingModel->update($id, $data);
        } else {
            $marketingModel->insert($data);
        }

        return redirect()->to('/marketing');
    }

    public function update($id)
    {
        $marketingModel = new MarketingModel();

        $data = [
            'nama_marketing' => $this->request->getPost('nama_marketing'),
            'alamat_marketing' => $this->request->getPost('alamat_marketing'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email')
        ];

        $marketingModel->update($id, $data);

        return redirect()->to('/marketing');
    }

    public function delete($id)
    {
        $marketingModel = new MarketingModel();
        $marketingModel->delete($id);

        return redirect()->to('/marketing');
    }
}
