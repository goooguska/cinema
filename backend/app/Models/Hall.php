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

    public function getSeatMap()
    {
        $capacity = $this->capacity;
        $rows = ceil($capacity / 10);
        $seatsPerRow = 10;

        $allSeats = [];
        for ($row = 1; $row <= $rows; $row++) {
            for ($seat = 1; $seat <= $seatsPerRow; $seat++) {
                if (($row-1)*10 + $seat > $capacity) break;
                $allSeats[] = "{$row}-{$seat}";
            }
        }
        return $allSeats;
    }

}
