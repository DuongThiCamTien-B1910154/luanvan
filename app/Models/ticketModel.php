<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticketModel extends Model
{
    use HasFactory;
    protected $table = "vexe";
    // public $timestamps = false;
    protected $primaryKey = 'idvx';
    protected $fillable = [
        'idvx',
        'idghe',
        'id_c_ng_g_x',
        'idkh',
        'giave',
        'sdt2',
        'tennd2',
        'note',
        'PTTT',
        'TTV',
        'rate'
    ];
}
