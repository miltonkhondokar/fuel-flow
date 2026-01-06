<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PumpFuelReading extends Model
{
    use HasFactory;

    protected $table = 'pump_fuel_readings';

    protected $fillable = [
        'uuid',
        'pump_uuid',
        'fuel_type_uuid',
        'nozzle_number',
        'reading',
        'reading_date',
        'is_active',
    ];

    protected $casts = [
        'reading' => 'decimal:3',
        'reading_date' => 'date',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->uuid) $model->uuid = (string) Str::uuid();
        });
    }

    // Relations
    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_uuid', 'uuid');
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_uuid', 'uuid');
    }
}
