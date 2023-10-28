<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chairModel extends Model
{
    use HasFactory;
    protected $table = "ghe";
    public $timestamps = false;
    protected $primaryKey = 'idghe';
    protected $fillable = [
        'idghe',
        'maghe',
        'idxe',
    ];
}
