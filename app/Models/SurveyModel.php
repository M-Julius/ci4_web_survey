<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyModel extends Model
{
    protected $table = 'survey';
    protected $primaryKey = 'survey_id';
    protected $allowedFields = ['id_marketing', 'id_komoditas', 'id_lokasi', 'hasil_survey', 'repeat_order', 'survey_datetime'];
}
