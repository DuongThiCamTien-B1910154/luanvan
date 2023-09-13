<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class positionModel extends Model
{
    use HasFactory;
    protected $table = "chucvu";
    public $timestamps = false;
    protected $primaryKey = 'idcv';
    protected $fillable = [
        'idcv',
        'tencv',
    ];
    public function getAllPosition()
    {
        return positionModel::all();
    }
}
