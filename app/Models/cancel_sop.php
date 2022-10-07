<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cancel_sop extends Model
{
    use HasFactory;

    protected $primaryKey = 'cancel_sops_id';
    protected $fillable = ['cancel_sops_description'];
    protected $hidden = ['created_at', 'updated_at'];

}
