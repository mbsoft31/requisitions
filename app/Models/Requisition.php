<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requisition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static int $PREPARATION = 0;
    public static int $MANAGEMENT = 1;

    public static array $types = [
        "تحضير",
        "تسيير",
    ];

    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

}
