<?php

namespace App\Controllers;

use App\Models\LokasiModel;
use App\Models\SurveyModel;
use CodeIgniter\Controller;

class Lokasi extends Controller
{
    protected $lokasiModel;
    protected $surveysModel;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
        $this->surveysModel = new SurveyModel();
    }
    public function index()
    {
        $data['lokasis'] = $this->lokasiModel->findAll();

        return view("lokasi/index", $data); // Adjust the view path as needed
    }

    public function store()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
        ];


        if ($id != null) {
            $this->lokasiModel->update($id, $data);
        } else {
            $this->lokasiModel->insert($data);
        }

        return redirect()->to('/lokasi');
    }

    public function update($id = null)
    {
        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
        ];

        $this->lokasiModel->update($id, $data);

        return redirect()->to('/lokasi');
    }

    public function delete($id = null)
    {
        $result = $this->surveysModel->select('COUNT(*) as total')->where('id_lokasi', $id)->findAll();

        if ($result) {
            $totalSurveys = $result[0]['total'];

            if ($totalSurveys > 0) {
                // Kirim respons ke sisi pengguna menggunakan alert Javascript
                $response['message'] = 'Lokasi masih digunakan dalam survei. Tidak dapat dihapus.';
                $response['success'] = false;
                echo json_encode($response);
            } else {
                // Lakukan penghapusan barang karena tidak ada survei yang terkait
                $this->lokasiModel->delete($id);

                $response['message'] = 'Lokasi berhasil dihapus.';
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
