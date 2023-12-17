<?php

namespace App\Controllers;

use App\Models\SurveyModel;
use App\Models\MarketingModel;
use App\Models\BarangModel;
use App\Models\LokasiModel;
use CodeIgniter\Controller;
use Config\Database;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Libraries\Pdfgenerator;


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
    public function export()
    {
        $userModel = new SurveyModel();
        $users = $userModel->findAll();

        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Marketing')
            ->setCellValue('B1', 'Nama Komoditas')
            ->setCellValue('C1', 'Alamat Lokasi')
            ->setCellValue('D1', 'Hasil Survey')
            ->setCellValue('E1', 'Repeat Order')
            ->setCellValue('F1', 'survey_datetime');



        $column = 2;

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:F1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFF0000');
            
        foreach ($users as $user) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $user['id_marketing'])
                ->setCellValue('B' . $column, $user['id_komoditas'])
                ->setCellValue('C' . $column, $user['id_lokasi'])
                ->setCellValue('D' . $column, $user['hasil_survey'])
                ->setCellValue('E' . $column, $user['repeat_order'])
                ->setCellValue('F' . $column, $user['survey_datetime']);



            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-Survey';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
    public function view_pdf_survey()
    {
        $Pdfgenerator = new Pdfgenerator();
        
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
        // filename dari pdf ketika didownload
        $file_pdf = 'data_management_survey';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('survey_pdf', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
