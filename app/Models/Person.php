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
    public static $classes = [
        1 => 'الأول',
        2 => 'الأول',
        3 => 'الأول',
        4 => 'الأول',
        5 => 'الأول',
        6 => 'الأول',
        7 => 'الأول',
        8 => 'الثاني',
        9 => 'الثاني',
        10 => 'الثاني',
        11 => 'الثالث',
        12 => 'الثالث',
        13 => 'الثالث',
        14 => 'الرابع',
        15 => 'الرابع',
        16 => 'الرابع',
        17 => 'الرابع',
        18 => 'الرابع',
        19 => 'الرابع',
        20 => 'الرابع',
        21 => "الخامس",
        22 => "السادس",
        23 => "السابع",
        24 => "الثامن",
        25 => "التاسع",
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

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
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
