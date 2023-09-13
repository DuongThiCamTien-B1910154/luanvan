<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tripModel extends Model
{
    use HasFactory;
    protected $table = "chuyen";
    public $timestamps = false;
    protected $primaryKey = 'idchuyen';
    protected $fillable = [
        'idchuyen',
        'idadmin',
        'idtuyen',
    ];
}
