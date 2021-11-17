<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Mitras extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    protected $guarded = [];
    protected $keyType = 'string';
    public $incrementing = false;
    use SoftDeletes;

    public function educationdetail()
    {
        return $this->belongsTo(Educations::class, 'education');
    }
    public function villagedetail()
    {
        return $this->belongsTo(Villages::class, 'village');
    }
    public function subdistrictdetail()
    {
        return $this->belongsTo(Subdistricts::class, 'subdistrict');
    }
    public function surveys()
    {
        return $this->belongsToMany(Surveys::class, 'mitras_surveys', 'mitra_id', 'survey_id', 'email', 'id')->withPivot('id', 'status_id', 'assessment_id', 'phone_survey');
    }
    public function avgrating()
    {
        $data = DB::select('SELECT `assessmentvalue`.`mitra_id`, `assessmentvalue`.`cooperation`, `assessmentvalue`.`communication`, `assessmentvalue`.`dicipline`, `assessmentvalue`.`itskill`, `assessmentvalue`.`integrity`, `mitras`.`name`, (`assessmentvalue`.`cooperation` + `assessmentvalue`.`communication` + `assessmentvalue`.`dicipline`+ `assessmentvalue`.`itskill`+ `assessmentvalue`.`integrity`)/5 AS `totalaverage` FROM (SELECT `mitra_id`, AVG(`cooperation`) AS `cooperation`, AVG(`communication`) AS `communication`, AVG(`dicipline`) AS `dicipline`, AVG(`itskill`) AS `itskill`, AVG(`integrity`) AS `integrity` FROM `assessments`, `mitras_surveys` WHERE `assessments`.`id` = `mitras_surveys`.`assessment_id` AND `mitras_surveys`.`mitra_id` = "' . $this->email . '" GROUP BY `mitra_id`) AS `assessmentvalue`, `mitras` WHERE `mitras`.email = `assessmentvalue`.mitra_id');
        if (count($data) > 0) {
            return number_format((float)$data[0]->totalaverage, 2, '.', '');
        }
        return '-';
    }

    public function phonenumbers()
    {
        return $this->hasMany(PhoneNumbers::class, 'mitra_id', 'email');
    }
    // public function total()
    // {
    // 	$sql = "SELECT * FROM mitras";
    // 	$query = $this->db->query($sql);
    // 	return $query->num_rows();
    // }
}
