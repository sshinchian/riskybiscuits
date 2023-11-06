<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WorkSlotBid extends Model
{
    use HasFactory;
    use SoftDeletes;

    /*
    protected $fillable = [
        'cafe_id',
        'work_slot_id',
        'user_id',
    ];

    protected $fillable = [
        
    ];
    */
    protected $fillable = [
    'work_slot_id',
    'user_id',
    'status',
    'created_at', // You can remove this if it's not needed to be mass assignable
];

}