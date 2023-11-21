<?php

namespace App\Controllers;

use App\Models\LokasiModel;
use CodeIgniter\Controller;

class LokasiController extends Controller
{
    public function index()
    {
        $model               = new LokasiModel();
        $data['lokasis']     = $model->findAll();

        return view("lokasi/index", $data); // Adjust the view path as needed
    }

    public function store()
    {
        $data = [
            'nama_lokasi'    => $this->request->getPost('nama_lokasi'),
            'alamat_lokasi'  => $this->request->getPost('alamat_lokasi'),
        ];

        $model = new LokasiModel();
        $model->insert($data);

        return redirect()->to('/lokasi');
    }

    public function update($id = null)
    {
        $data = [
            'nama_lokasi'    => $this->request->getPost('nama_lokasi'),
            'alamat_lokasi'  => $this->request->getPost('alamat_lokasi'),
        ];

        $model = new LokasiModel();
        $model->update($id, $data);

        return redirect()->to('/lokasi');
    }

    public function delete($id = null)
    {
        $model = new LokasiModel();
        $model->delete($id);

        return redirect()->to('/lokasi');
    }
}
