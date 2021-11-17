<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    public static $ranks = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
        14 => 14,
        15 => 15,
        16 => 16,
        17 => 17,
        18 => 18,
        19 => 19,
        20 => 20,
        21 => "وظيفة سامية",
        22 => "عضو لجنة إنتخابية بلدية",
        23 => "رئيس لجنة إنتخابية بلدية",
        24 => "عضو لجنة مراجعة القوائم الإنتخابية",
        25 => "رئيس لجنة مراجعة القوائم الإنتخابية",
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requisitions(): HasMany
    {
        return $this->hasMany(Requisition::class);
    }

    public function getPreparationRequisitionAttribute(): ?Requisition
    {
        return $this->requisitions()->where('type', Requisition::$PREPARATION)->first();
    }

    public function getManagementRequisitionAttribute(): ?Requisition
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
