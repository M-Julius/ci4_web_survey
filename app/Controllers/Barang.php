<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\SurveyModel;
use Config\Database;

class Barang extends BaseController
{
    protected $db;
    protected $surveysModel;
    protected $barangModel;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->surveysModel = new SurveyModel();
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        $data['barangs'] = $this->barangModel->findAll();

        return view("barang/index", $data);
    }


    public function store()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'harga' => $this->request->getPost('harga'),
        ];


        if ($id != null) {
            $this->barangModel->update($id, $data);
        } else {
            $this->barangModel->insert($data);
        }

        return redirect()->to('/barang');
    }

    public function delete($id = null)
    {
        $result = $this->surveysModel->select('COUNT(*) as total')->where('id_komoditas', $id)->findAll();

        if ($result) {
            $totalSurveys = $result[0]['total'];

            if ($totalSurveys > 0) {
                // Kirim respons ke sisi pengguna menggunakan alert Javascript
                $response['message'] = 'Barang masih digunakan dalam survei. Tidak dapat dihapus.';
                $response['success'] = false;
                echo json_encode($response);
            } else {
                // Lakukan penghapusan barang karena tidak ada survei yang terkait
                $this->barangModel->delete($id);
                
                $response['message'] = 'Barang berhasil dihapus.';
                $response['success'] = true;
                echo json_encode($response);
    
            }
        } else {
            // Kesalahan saat mengecek ketergantungan survei
            $response['message'] = 'Terjadi kesalahan saat memeriksa ketergantungan survei.';
            $response['success'] = false;
            echo json_encode($response);
        }
    }
}
