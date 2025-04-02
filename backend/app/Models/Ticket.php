<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'screening_id',
        'user_id',
        'price',
        'status',
        'seat_number'
    ];

    protected $casts = [
        'seat_number' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $hallCapacity = $model->screening->hall->capacity;

            if ($model->seat_number < 1 || $model->seat_number > $hallCapacity) {
                throw new \Exception("Seat number must be between 1 and {$hallCapacity}");
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function screening(): BelongsTo
    {
        return $this->belongsTo(Screening::class);
    }

}
