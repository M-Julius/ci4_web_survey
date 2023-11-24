<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketingModel extends Model
{
    protected $table = 'marketing';
    protected $primaryKey = 'marketing_id';
    protected $allowedFields = ['nama_marketing', 'alamat_marketing', 'nomor_telepon', 'email'];
}
