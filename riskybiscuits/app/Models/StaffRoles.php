<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StaffRoles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'role_id',
    ];


    //One To Many Relationships
    //Each staff role has many users
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
    //Each Staff Role has many Staff Role Bids from users
    public function staffRoleBids(): HasMany {
        return $this->HasMany(StaffRoleBid::class);
    }
    
    //One To Many (Inverse) / Belongs To Relationship
    public function workSlots():BelongsTo {
        return $this->belongsTo(WorkSlot::class);
    }

    public function workSlots2() {
        return $this->hasMany('App\Models\WorkSlot');
    }
}
