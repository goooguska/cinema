<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    use HasFactory;

    protected $table = 'halls';

    protected $fillable = [
        'number',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->capacity > 60) {
                throw new \Exception("Capacity cannot exceed 60 seats");
            }
        });
    }

    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }

    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }
}
