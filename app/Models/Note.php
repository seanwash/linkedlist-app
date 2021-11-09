<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, GeneratesUuid, SoftDeletes;

    protected $fillable = ['title', 'content', 'for_date'];

    protected $casts = [
        'for_date' => 'date'
    ];

    public function scopeDaily($query)
    {
        return $query->whereNotNull('for_date');
    }

    public function scopeOrderByForDate($query): Builder
    {
        return $query->orderByDesc('for_date');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
