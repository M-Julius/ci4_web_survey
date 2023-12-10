<?php

namespace App\Controllers;
use App\Models\BarangModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Libraries\Pdfgenerator;

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
        $id = $this->request->getPost('id');
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'harga' => $this->request->getPost('harga'),
        ];

        $model = new BarangModel();

        if ($id != null) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('/barang');
    }

    public function update($id = null)
    {
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'deskripsi_barang' => $this->request->getPost('deskripsi_barang'),
            'harga' => $this->request->getPost('harga'),
        ];



        return redirect()->to('/barang');
    }

    public function delete($id = null)
    {
        $model = new BarangModel();
        $model->delete($id);

        return redirect()->to('/barang');
    }

    public function export()
    {
        $userModel = new BarangModel();
        $users = $userModel->findAll();

        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Deskripsi')
            ->setCellValue('C1', 'Harga');

        $column = 2;

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:C1')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFF0000');
            
        foreach ($users as $user) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $user['nama_barang'])
                ->setCellValue('B' . $column, $user['deskripsi_barang'])
                ->setCellValue('C' . $column, $user['harga']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-Barang';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
    public function view_pdf()
    {
        $Pdfgenerator = new Pdfgenerator();
        $model = new BarangModel();
        $data['barangs'] = $model->findAll();

        // filename dari pdf ketika didownload
        $file_pdf = 'data_management_barang';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('barang_pdf', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
