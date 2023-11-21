<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'barang_id';
    protected $allowedFields = ['nama_barang', 'deskripsi_barang', 'harga'];
}