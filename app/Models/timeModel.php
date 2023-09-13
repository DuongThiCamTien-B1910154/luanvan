<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timeModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "gio";
    protected $primaryKey = 'idgio';
    protected $fillable = [
        'idgio',
        'tg_xuatben',
    ];
}
