<?php

namespace App\Controllers;

use App\Models\SurveyModel;
use App\Models\MarketingModel;
use App\Models\BarangModel;
use App\Models\LokasiModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $surveyModel = new SurveyModel();
        $marketingModel = new MarketingModel();
        $barangModel = new BarangModel();
        $lokasiModel = new LokasiModel();

        $totalMarketing = $marketingModel->countAll();
        $totalBarang = $barangModel->countAll();
        $totalLokasi = $lokasiModel->countAll();
        $totalSurveys = $surveyModel->countAll();

        $startOfMonth = date('Y-m-01');
        $endOfMonth = date('Y-m-t');

        $surveysByLocation = $surveyModel->select('id_lokasi, nama_lokasi, COUNT(*) as total_surveys')
            ->where('survey_datetime >=', $startOfMonth)
            ->where('survey_datetime <=', $endOfMonth)
            ->join('lokasi', 'lokasi.lokasi_id = survey.id_lokasi')
            ->groupBy('id_lokasi')
            ->findAll();

        $data['surveysByLocation'] = $surveysByLocation;
        $data['totalMarketing'] = $totalMarketing;
        $data['totalBarang'] = $totalBarang;
        $data['totalLokasi'] = $totalLokasi;
        $data['totalSurveys'] = $totalSurveys;

        return view('dashboard/index', $data);
    }
}
