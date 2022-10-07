<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sop_general extends Model
{
    use HasFactory;

    protected $primaryKey = 'sop_generals_id';
    protected $fillable = ['sop_generals_description', 'sop_generals_asuransi'];
    protected $hidden = ['created_at', 'updated_at'];

    // public function province()
    // {
    //     return $this->belongsTo(Province::class, 'province_id', 'province_id');
    // }

    // public function subdistricts()
    // {
    //     return $this->hasMany(Subdistrict::class, 'city_id', 'city_id');
    // }

}
