<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PumpComplaint extends Model
{
    use HasFactory;

    protected $table = 'pump_complaints';

    protected $fillable = [
        'uuid',
        'pump_uuid',
        'category',
        'title',
        'description',
        'status',
        'complaint_date',
        'resolved_date',
        'is_active',
    ];

    protected $casts = [
        'complaint_date' => 'date',
        'resolved_date' => 'date',
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
}
