<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeBusModel extends Model
{
    use HasFactory;
    protected $table = "loaixe";
    public $timestamps = false;
    protected $primaryKey = 'idlx';
    protected $fillable = [
        'idlx',
        'tenloai',
    ];
    public function getAllTypeBus()
    {
        return typeBusModel::all();
    }
}
