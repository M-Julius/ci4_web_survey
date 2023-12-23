<?php

namespace App\Controllers;

use App\Models\MarketingModel;
use App\Models\SurveyModel;
use CodeIgniter\Controller;

class Marketing extends Controller
{
    protected $marketingModel;
    protected $surveysModel;

    public function __construct()
    {
        $this->marketingModel = new MarketingModel();
        $this->surveysModel = new SurveyModel();
    }
    public function index()
    {
        $data['marketing'] = $this->marketingModel->findAll();

        return view('marketing/index', $data);
    }

    public function store()
    {
        $id = $this->request->getPost('id');

        $data = [
            'nama_marketing' => $this->request->getPost('nama_marketing'),
            'alamat_marketing' => $this->request->getPost('alamat_marketing'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email')
        ];

        if ($id != null) {
            $this->marketingModel->update($id, $data);
        } else {
            $this->marketingModel->insert($data);
        }

        return redirect()->to('/marketing');
    }

    public function update($id)
    {
        $data = [
            'nama_marketing' => $this->request->getPost('nama_marketing'),
            'alamat_marketing' => $this->request->getPost('alamat_marketing'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email')
        ];

        $this->marketingModel->update($id, $data);

        return redirect()->to('/marketing');
    }

    public function delete($id = null)
    {
        $result = $this->surveysModel->select('COUNT(*) as total')->where('id_marketing', $id)->findAll();

        if ($result) {
            $totalSurveys = $result[0]['total'];

            if ($totalSurveys > 0) {
                // Kirim respons ke sisi pengguna menggunakan alert Javascript
                $response['message'] = 'Marketing masih digunakan dalam survei. Tidak dapat dihapus.';
                $response['success'] = false;
                echo json_encode($response);
            } else {
                // Lakukan penghapusan barang karena tidak ada survei yang terkait
                $this->marketingModel->delete($id);

                $response['message'] = 'Marketing berhasil dihapus.';
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
