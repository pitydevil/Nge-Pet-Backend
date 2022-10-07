<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringImage extends Model
{
    use HasFactory;
    protected $table='monitoring_images';

    protected $primaryKey = 'monitoring_image_id';
    protected $fillable = ['monitoring_image_url'];
    protected $hidden = ['created_at', 'updated_at'];

    
    public function monitoring() {
        return $this->belongsTo(Monitoring::class, 'monitoring_image_id', 'monitoring_image_id');
    }
}
