<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tripDayTimeBusModel extends Model
{
    use HasFactory;
    protected $table = "c_ng_g_x";
    public $timestamps = false;
    protected $primaryKey = 'id_c_ng_g_x';
    protected $fillable = [
        'id_c_ng_g_x',
        'idchuyen',
        'idngay',
        'idgio',
        'idxe'
    ];
}
