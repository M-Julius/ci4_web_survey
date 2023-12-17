<?php

namespace App\Controllers;

use App\Models\MarketingModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Libraries\Pdfgenerator;

class Marketing extends Controller
{
    public function index()
    {
        $marketingModel = new MarketingModel();
        $data['marketings'] = $marketingModel->findAll();

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
    public function export()
    {
        $userModel = new MarketingModel();
        $users = $userModel->findAll();

        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Marketing')
            ->setCellValue('B1', 'Alamat Marketing')
            ->setCellValue('C1', 'Email')
            ->setCellValue('D1', 'No Telepon');

        $column = 2;

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:D1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFF0000');
            
        foreach ($users as $user) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $user['nama_marketing'])
                ->setCellValue('B' . $column, $user['alamat_marketing'])
                ->setCellValue('C' . $column, $user['email'])
                ->setCellValue('D' . $column, $user['nomor_telepon']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-Marketing';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
    public function view_pdf_marketing()
    {
        $Pdfgenerator = new Pdfgenerator();
        $model = new MarketingModel();
        $data['marketings'] = $model->findAll();

        // filename dari pdf ketika didownload
        $file_pdf = 'data_management_marketing';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('marketing_pdf', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
