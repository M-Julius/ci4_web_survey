<?php

namespace App\Controllers;
use App\Models\BarangModel;

class Barang extends BaseController
{
    public function index()
    {
        $model              =   new BarangModel();
        $data['barangs']    =   $model->findAll();

        return view("barang/index", $data);
    }


    public function store()
    {
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'harga' => $this->request->getPost('harga'),
        ];

        $model = new BarangModel();
        $model->insert($data);

        return redirect()->to('/barang');
    }

    public function update($id = null)
    {
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'harga' => $this->request->getPost('harga'),
        ];

        $model = new BarangModel();
        $model->update($id, $data);

        return redirect()->to('/barang');
    }

    public function delete($id = null)
    {
        $model = new BarangModel();
        $model->delete($id);

        return redirect()->to('/barang');
    }
}
