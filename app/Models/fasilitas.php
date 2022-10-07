<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
    use HasFactory;

    protected $primaryKey = 'fasilitas_id';
    protected $fillable = ['fasilitas_name', 'fasilitas_description'];
    protected $hidden = ['created_at', 'updated_at'];

}
