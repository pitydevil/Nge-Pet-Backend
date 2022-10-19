<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    protected $table='package_details';

    protected $primaryKey = 'package_detail_id';
    protected $fillable = ['package_detail_name', 'package_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }
}
