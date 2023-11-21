<?php

namespace App\Controllers;
use App\Models\BarangModel;

class Barang extends BaseController
{
    public function index()
    {
        return view("barang/index");
    }
}
