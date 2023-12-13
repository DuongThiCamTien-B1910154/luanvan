<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workModel extends Model
{
    use HasFactory;
    protected $table = "w_seat";
    public $timestamps = false;
    protected $primaryKey = 'id_w';
    protected $fillable = [
        'idghe',
        'idkh',
    ];
}
