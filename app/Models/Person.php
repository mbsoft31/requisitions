<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requisitions() : HasMany
    {
        return $this->hasMany(Requisition::class);
    }

    public function getPreparationRequisitionAttribute() : ?Requisition
    {
        return $this->requisitions()->where('type', Requisition::$PREPARATION)->first();
    }

    public function getManagementRequisitionAttribute() : ?Requisition
    {
        return $this->requisitions()->where('type', Requisition::$MANAGEMENT)->first();
    }

    /**
     * @return bool
     */
    public function getHasPreparationAttribute(): bool
    {
        return $this->requisitions()->where('type', Requisition::$PREPARATION)->exists();
    }

    /**
     * @return bool
     */
    public function getHasManagementAttribute(): bool
    {
        return $this->requisitions()->where('type', Requisition::$MANAGEMENT)->exists();
    }

}
