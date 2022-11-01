<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomSOP;
use App\Models\Monitoring;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table='order_details';

    protected $primaryKey = 'order_detail_id';
    protected $fillable = ['pet_name', 'pet_type', 'pet_size','order_detail_price', 'order_id', 'package_id'];
   // protected $hidden = [ 'order_id', 'package_id' ,'created_at', 'updated_at'];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function package() {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function customSOP()
    {
        return $this->hasMany(CustomSOP::class, 'order_detail_id');
    }
}
