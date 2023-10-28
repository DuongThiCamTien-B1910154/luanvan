<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankingModel extends Model
{
    use HasFactory;
    protected $table = "pttt";
    public $timestamps = false;
    protected $primaryKey = 'idtt';
    protected $fillable = [
        'idtt',
        'tentt',
    ];
}
