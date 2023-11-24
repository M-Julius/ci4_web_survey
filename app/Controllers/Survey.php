<?php

namespace App\Controllers;

use App\Models\SurveyModel;
use App\Models\MarketingModel;
use App\Models\BarangModel;
use App\Models\LokasiModel;
use CodeIgniter\Controller;
use Config\Database;


class Survey extends Controller
{
    public function index()
    {
        $db = Database::connect();

        $query = $db->query('SELECT survey.survey_id, survey.hasil_survey, survey.repeat_order, survey.survey_datetime, 
                            marketing.nama_marketing, lokasi.nama_lokasi, barang.nama_barang
                            FROM survey 
                            INNER JOIN marketing ON marketing.marketing_id = survey.id_marketing 
                            INNER JOIN barang ON barang.barang_id = survey.id_komoditas
                            INNER JOIN lokasi ON lokasi.lokasi_id = survey.id_lokasi');
        $surveys = $query->getResult();

        $data['surveys'] = $surveys;


        $surveyModel = new SurveyModel();
        $surveys = $surveyModel->findAll();

        $marketingModel = new MarketingModel();
        $lokasiModel = new LokasiModel();
        $barangModel = new BarangModel();

        $data['locations'] = $lokasiModel->findAll();
        $data['komoditas'] = $barangModel->findAll();
        $data['marketings'] = $marketingModel->findAll();

        return view('survey/index', $data);
    }

    public function store()
    {
        $surveyModel = new SurveyModel();

        $data = [
            'id_marketing' => $this->request->getPost('id_marketing'),
            'id_komoditas' => $this->request->getPost('id_komoditas'),
            'id_lokasi' => $this->request->getPost('id_lokasi'),
            'hasil_survey' => $this->request->getPost('hasil_survey'),
            'repeat_order' => $this->request->getPost('repeat_order'),
            'survey_datetime' => date('Y-m-d H:i:s')
        ];

        $surveyModel->insert($data);

        return redirect()->to('/survey');
    }


    public function delete($id)
    {
        $surveyModel = new SurveyModel();
        $surveyModel->delete($id);

        return redirect()->to('/survey');
    }
}
