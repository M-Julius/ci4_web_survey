<?php

namespace App\Controllers;

use App\Models\SurveyModel;
use App\Models\MarketingModel;
use App\Models\BarangModel;
use App\Models\LokasiModel;
use CodeIgniter\Controller;
use Config\Database;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;


class Survey extends Controller
{

    protected $db;
    protected $surveyModel;
    protected $marketingModel;
    protected $lokasiModel;
    protected $barangModel;
    protected $mpdf;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->surveyModel = new SurveyModel();
        $this->marketingModel = new MarketingModel();
        $this->lokasiModel = new LokasiModel();
        $this->barangModel = new BarangModel();
        $this->mpdf = new Mpdf();
    }

    public function surveyData($id = null)
    {
        if ($id != null) {
            $query = $this->db->query('
            SELECT 
                survey.survey_id, survey.hasil_survey, survey.repeat_order, survey.survey_datetime, 
                marketing.nama_marketing, lokasi.nama_lokasi, barang.nama_barang
            FROM 
                survey
            INNER JOIN 
                marketing ON marketing.marketing_id = survey.id_marketing 
            INNER JOIN 
                barang ON barang.barang_id = survey.id_komoditas
            INNER JOIN 
                lokasi ON lokasi.lokasi_id = survey.id_lokasi
            WHERE 
                survey.survey_id = ' . $id . '
            ORDER BY 
                survey.survey_datetime DESC
        ');
        $surveys = $query->getResult();
        } else {
            $query = $this->db->query('SELECT survey.survey_id, survey.hasil_survey, survey.repeat_order, survey.survey_datetime, 
    marketing.nama_marketing, lokasi.nama_lokasi, barang.nama_barang
    FROM survey
    INNER JOIN marketing ON marketing.marketing_id = survey.id_marketing 
    INNER JOIN barang ON barang.barang_id = survey.id_komoditas
    INNER JOIN lokasi ON lokasi.lokasi_id = survey.id_lokasi
    ORDER BY survey.survey_datetime DESC');
            $surveys = $query->getResult();
        }

        return $surveys;
    }

    public function index()
    {
        $surveys = $this->surveyData();

        $data['surveys'] = $surveys;

        $data['locations'] = $this->lokasiModel->findAll();
        $data['komoditas'] = $this->barangModel->findAll();
        $data['marketings'] = $this->marketingModel->findAll();

        return view('survey/index', $data);
    }

    public function store()
    {
        $id = $this->request->getPost('id');

        $data = [
            'id_marketing' => $this->request->getPost('id_marketing'),
            'id_komoditas' => $this->request->getPost('id_komoditas'),
            'id_lokasi' => $this->request->getPost('id_lokasi'),
            'hasil_survey' => $this->request->getPost('hasil_survey'),
            'repeat_order' => $this->request->getPost('repeat_order'),
            'survey_datetime' => date('Y-m-d H:i:s')
        ];

        if ($id != null) {
            $this->surveyModel->update($id, $data);
        } else {
            $this->surveyModel->insert($data);
        }

        return redirect()->to('/survey');
    }


    public function delete($id)
    {
        $this->surveyModel->delete($id);

        return redirect()->to('/survey');
    }

    public function exportExcel()
    {

        $surveys = $this->surveyData();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID Survey');
        $sheet->setCellValue('B1', 'Nama Marketing');
        $sheet->setCellValue('C1', 'Nama Komoditas');
        $sheet->setCellValue('D1', 'Nama Lokasi');
        $sheet->setCellValue('E1', 'Hasil Survey');
        $sheet->setCellValue('F1', 'Repeat Order');
        $sheet->setCellValue('G1', 'Tanggal Survey');

        $row = 2;
        foreach ($surveys as $survey) {
            $repeatOrder = ($survey->repeat_order == 1) ? 'Ya' : 'Tidak';

            $sheet->setCellValue('A' . $row, $survey->survey_id);
            $sheet->setCellValue('B' . $row, $survey->nama_marketing);
            $sheet->setCellValue('C' . $row, $survey->nama_barang);
            $sheet->setCellValue('D' . $row, $survey->nama_lokasi);
            $sheet->setCellValue('E' . $row, $survey->hasil_survey);
            $sheet->setCellValue('F' . $row, $repeatOrder);
            $sheet->setCellValue('G' . $row, $survey->survey_datetime);
            // Lanjutkan menulis data lain sesuai dengan struktur data
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'surveys-'.date('d-m-Y').'.xlsx';

        // Tambahkan header untuk memunculkan dialog download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function exportPDF()
    {
        $surveys = $this->surveyData();

        // Mulai menulis konten ke PDF
        $html = '<h1>Data Survei</h1>';

        $html .= '<table border="1">';
        $html .= '<tr><th>ID Survey</th><th>Nama Marketing</th><th>Nama Komoditas</th><th>Nama Lokasi</th><th>Hasil Survey</th><th>Repeat Order</th><th>Tanggal Survey</th></tr>';
        foreach ($surveys as $survey) {
            $repeatOrder = ($survey->repeat_order == 1) ? 'Ya' : 'Tidak';
            $html .= '<tr>';
            $html .= '<td>' . $survey->survey_id . '</td>';
            $html .= '<td>' . $survey->nama_marketing . '</td>';
            $html .= '<td>' . $survey->nama_barang . '</td>';
            $html .= '<td>' . $survey->nama_lokasi . '</td>';
            $html .= '<td>' . $survey->hasil_survey . '</td>';
            $html .= '<td>' . $repeatOrder . '</td>';
            $html .= '<td>' . $survey->survey_datetime . '</td>';
            // Lanjutkan menulis data lain sesuai dengan struktur data
            $html .= '</tr>';
        }
        $html .= '</table>';

        // Tambahkan konten ke PDF
        $this->mpdf->WriteHTML($html);

        // Simpan PDF atau tampilkan secara langsung
        $this->mpdf->Output('surveys-'. date('d-m-Y') .'.pdf', 'D');
    }

    public function exportItemToPDF($survey_id)
    {
        $survey = $this->surveyData($survey_id)[0];

        $repeatOrder = ($survey->repeat_order == 1) ? 'Ya' : 'Tidak';

        $html = '<h1>Data Survei</h1>';

        $html .= '<div>';
        $html .= '<p><strong>ID Survey:</strong> ' . $survey->survey_id . '</p>';
        $html .= '<p><strong>Nama Marketing:</strong> ' . $survey->nama_marketing . '</p>';
        $html .= '<p><strong>Nama Komoditas:</strong> ' . $survey->nama_barang . '</p>';
        $html .= '<p><strong>Nama Lokasi:</strong> ' . $survey->nama_lokasi . '</p>';
        $html .= '<p><strong>Hasil Survey:</strong> ' . $survey->hasil_survey . '</p>';
        $html .= '<p><strong>Repeat Order:</strong> ' . $repeatOrder . '</p>';
        $html .= '<p><strong>Tanggal Survey:</strong> ' . $survey->survey_datetime . '</p>';

        $html .= '</div>';

        // Tambahkan konten ke PDF
        $this->mpdf->WriteHTML($html);

        // Simpan PDF atau tampilkan secara langsung
        $this->mpdf->Output('survey-'. date('d-m-Y') .'.pdf', 'D');
    }
}
