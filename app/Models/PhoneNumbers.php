<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumbers extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function mitradetail()
    {
        return $this->belongsTo(Mitras::class, 'mitra_id');
    }
}
