<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WorkSlot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'time_slot_name',
        'start_date',
        'end_date',
        'date',
        'start_time',
        'end_time',
        'staff_role_id',
        'quantity',
    ];
    

    //One to One Relationship
    //Each Work Slot can be created by one user
    public function users() : BelongsTo{
        return $this->belongsTo(User::class,'id','user_id');
    }

    //One To Many Relationships
    //Each Work Slot is for One Staff Role
    public function staffRole():HasOne
    {
        return $this->hasOne(StaffRoles::class);
    }
    //Each Work Slot has many Work Slot Bids
    public function workSlotBid(): HasMany
    {
        return $this->hasMany(WorkSlotBid::class);
    }

    public function role() {
        return $this->belongsTo('App\Models\StaffRoles', 'staff_role_id');
    }

}
