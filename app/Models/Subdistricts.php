<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistricts extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function villages()
    {
        return $this->hasMany(Villages::class, 'district');
    }
    public function mitras()
    {
        return $this->hasMany(Mitras::class, 'education', 'subdistrict');
    }
}
