<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class routeModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tuyen";
    protected $primaryKey = 'idtuyen';
    protected $fillable = [
        'idtuyen',
        'tentuyen',
        'diemKH',
        'diemKT',
        'tg_dukien',
        'tansuat',
        'giave'
    ];
}
