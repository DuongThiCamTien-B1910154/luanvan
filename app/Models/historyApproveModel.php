<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historyApproveModel extends Model
{
    use HasFactory;
    protected $table = "lichsusoatve";
    public $timestamps = false;
    protected $primaryKey = 'idlssv';
    protected $fillable = [
        'idlssv',
        'idadmin',
        'iddc',
    ];
}
