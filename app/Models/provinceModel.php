<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinceModel extends Model
{
    use HasFactory;
    protected $table = "tinhthanhpho";
    public $timestamps = false;
    protected $primaryKey = 'idtp';
    protected $fillable = [
        'idtp',
        'name',
        'type',
    ];
    public function getAllProvince()
    {
        return provinceModel::all();
    }
}
