<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class busModel extends Model
{
    use HasFactory;
    protected $table = "xe";
    public $timestamps = false;
    protected $primaryKey = 'idxe';
    protected $fillable = [
        'idxe',
        'bienso',
        'file_upload',
        'namsx',
        'idlx',
    ];
}
