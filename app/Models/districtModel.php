<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class districtModel extends Model
{
    use HasFactory;
    protected $table = "quanhuyen";
    public $timestamps = false;
    protected $primaryKey = 'idqh';
    protected $fillable = [
        'idqh',
        'name',
        'type',
        'idtp'
    ];
    public function getAllDistrict()
    {
        return districtModel::all();
    }
}
