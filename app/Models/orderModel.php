<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderModel extends Model
{
    use HasFactory;
    protected $table = "datcho";
    protected $primaryKey = 'iddc';
    protected $fillable = [
        'iddc',
        'id_c_ng_g_x',
        'idkh',
        'idtt',
        'idttv',
        'tennd2',
        'sdt2',
        'note',
        'del',
        'tongtien',
    ];
}

