<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movie';

    protected $fillable = [
        'title',
        'description',
        'format',
        'duration'
    ];

    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }

    public function actors(): BelongsTo
    {
        return $this->belongsTo(Actor::class);
    }

    public function directors(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }

    public function genres(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
