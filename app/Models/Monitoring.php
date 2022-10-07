<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table='monitorings';

    protected $primaryKey = 'monitoring_id';
    protected $fillable = ['monitoring_name', 'monitoring_image_id'];
    protected $hidden = ['monitoring_image_id', 'created_at', 'updated_at'];
}
