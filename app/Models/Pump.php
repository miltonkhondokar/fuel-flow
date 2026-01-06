<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pump extends Model
{
    use HasFactory;

    protected $table = 'pumps';

    protected $fillable = [
        'uuid',
        'user_uuid',
        'name',
        'location',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    // Relations

    public function manager()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function fuelPrices()
    {
        return $this->hasMany(PumpFuelPrice::class, 'pump_uuid', 'uuid');
    }

    public function fuelStocks()
    {
        return $this->hasMany(PumpFuelStock::class, 'pump_uuid', 'uuid');
    }

    public function fuelReadings()
    {
        return $this->hasMany(PumpFuelReading::class, 'pump_uuid', 'uuid');
    }

    public function costs()
    {
        return $this->hasMany(CostEntry::class, 'pump_uuid', 'uuid');
    }

    public function complaints()
    {
        return $this->hasMany(PumpComplaint::class, 'pump_uuid', 'uuid');
    }
}
