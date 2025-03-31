<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'description',
        'format',
        'duration',
        'poster_url',
        'year',
        'kp_id'
    ];

    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'movie_actors');
    }

    public function directors(): BelongsToMany
    {
        return $this->belongsToMany(Director::class, 'movie_directors');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movie_genres');
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'movie_countries');
    }
}
