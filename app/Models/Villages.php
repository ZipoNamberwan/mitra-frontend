<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function subdistrictdetail()
    {
        return $this->belongsTo(Subdistricts::class, 'subdistrict');
    }
    public function mitras()
    {
        return $this->hasMany(Mitras::class, 'education');
    }
}
