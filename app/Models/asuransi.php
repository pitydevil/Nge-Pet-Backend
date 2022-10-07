<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asuransi extends Model
{
    use HasFactory;
    protected $primaryKey = 'asuransi_id';
    protected $fillable = ['asuransi_name'];
    protected $hidden = ['created_at', 'updated_at'];

}
