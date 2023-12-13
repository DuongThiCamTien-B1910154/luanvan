<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissionModel extends Model
{
    use HasFactory;
    protected $table = "quyenhan";
    public $timestamps = false;
    protected $primaryKey = 'idqh';
    protected $fillable = [
        'idqh',
        'idkh',
    ];
}
