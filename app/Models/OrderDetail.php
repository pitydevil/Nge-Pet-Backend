<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table='order_details';

    protected $primaryKey = 'order_detail_id';
    protected $fillable = ['pet_name', 'pet_type','order_detail_price', 'order_id', 'monitoring_id', 'package_id', 'custom_sop_id'];
    protected $hidden = [ 'order_id', 'monitoring_id', 'package_id', 'custom_sop_id' ,'created_at', 'updated_at'];
}
