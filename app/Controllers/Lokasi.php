<?php

namespace App\Controllers;

use App\Models\LokasiModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Libraries\Pdfgenerator;

class Lokasi extends Controller
{
    public function index()
    {
        $model               = new LokasiModel();
        $data['lokasis']     = $model->findAll();

        return view("lokasi/index", $data); // Adjust the view path as needed
    }

    public function store()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nama_lokasi'    => $this->request->getPost('nama_lokasi'),
            'alamat_lokasi'  => $this->request->getPost('alamat_lokasi'),
        ];

        $model = new LokasiModel();
        
        if ($id != null) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

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
    public function export()
    {
        $userModel = new LokasiModel();
        $users = $userModel->findAll();

        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Alamat');
        $column = 2;

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:C1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFF0000');
            
        foreach ($users as $user) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $user['nama_lokasi'])
                ->setCellValue('B' . $column, $user['alamat_lokasi']);    
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-lokasi';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
    public function view_pdf_lokasi()
    {
        $Pdfgenerator = new Pdfgenerator();
        $model = new LokasiModel();
        $data['lokasis'] = $model->findAll();

        // filename dari pdf ketika didownload
        $file_pdf = 'data_management_lokasi';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('lokasi_pdf', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}

