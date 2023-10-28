<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticketModel extends Model
{
    use HasFactory;
    protected $table = "chitietdatcho";
    public $timestamps = false;
    protected $primaryKey = 'idctdc';
    protected $fillable = [
        'idctdc',
        'iddc',
        'idghe',
    ];
}
