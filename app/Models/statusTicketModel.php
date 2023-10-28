<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusTicketModel extends Model
{
    use HasFactory;
    protected $table = "trangthaive";
    public $timestamps = false;
    protected $primaryKey = 'idttv';
    protected $fillable = [
        'idttv',
        'tentrangthai',
    ];

}
