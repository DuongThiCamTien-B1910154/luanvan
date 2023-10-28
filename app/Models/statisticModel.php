<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statisticModel extends Model
{
    use HasFactory;
    protected $table = "thongke";
    public $timestamps = false;
    protected $primaryKey = 'idtk';
    protected $fillable = [
        'idtk',
        'ngayxechay',
        'tongtien',
        'soluongve',
    ];
}
