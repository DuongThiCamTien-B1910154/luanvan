<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratingModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "nhanxet";
    protected $primaryKey = 'idnx';
    protected $fillable = [
        'idnx',
        'iddc',
        'noidungbl',
        'rating',
    ];
}
