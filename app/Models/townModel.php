<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class townModel extends Model
{
    use HasFactory;
    protected $table = "xaphuongthitran";
    public $timestamps = false;
    protected $primaryKey = 'idxa';
    protected $fillable = [
        'idxa',
        'name',
        'type',
        'idqh'
    ];
    public function getAllTown()
    {
        return townModel::all();
    }
}
