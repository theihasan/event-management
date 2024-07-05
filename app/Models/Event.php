<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'user_id',
    ];

    public static function create(mixed $validated)
    {
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
