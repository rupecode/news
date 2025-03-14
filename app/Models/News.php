<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $owner
 */
class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'text',
        'user_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getHrefAttribute()
    {
        return '?1';
    }

    public function getCreatedAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
