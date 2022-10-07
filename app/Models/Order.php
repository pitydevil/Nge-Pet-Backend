<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $primaryKey = 'order_id';
    protected $fillable = ['order_name', 'order_status','order_checkin_date', 'order_checkout_date', 'user_id','pet_hotel_id'];
    protected $hidden = ['order_checkin_date', 'order_checkout_date','user_id', 'pet_hotel_id', 'created_at', 'updated_at'];
}
