<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StaffRoleBid extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cafe_id',
        'staff_role_id',
        'user_id',
        'status',
        'remarks'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id',);
    }
    public function staffRole(){
        return $this->belongsTo(StaffRoles::class,'id', 'staff_role_id');
    }
}