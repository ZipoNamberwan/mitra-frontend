<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveys extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function mitras()
    {
        return $this->belongsToMany(Mitras::class, 'mitras_surveys', 'survey_id', 'mitra_id', 'id', 'email')->withPivot('id', 'status_id', 'assessment_id', 'phone_survey');
    }
}
