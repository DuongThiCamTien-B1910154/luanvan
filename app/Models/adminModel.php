<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class adminModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = "admin";
    protected $primaryKey = 'idadmin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idadmin',
        'mand',
        'level',
        'namsinh',
        'email',
        'password',
        'idcv',
        'idxa',
        'idnd',
    ];

    public function getAllAdmin()
    {
        return adminModel::all();
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class adminModel extends Model
// {
//     use HasFactory;
//     public $timestamps = false;
//     protected $table = "admin";
//     protected $primaryKey = 'idadmin';
//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */

// }
