<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dayModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ngaychay";
    protected $primaryKey = 'idngay';
    protected $fillable = [
        'idngay',
        'ngaychay',
    ];
}
