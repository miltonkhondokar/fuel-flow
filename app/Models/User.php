<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use App\Constants\UserType;
use App\Constants\UserStatus;
use App\Constants\UserEmailVerificationStatus;

/**
 * @method bool hasRole(string|array $roles)
 * @method bool hasAnyRole(string|array $roles)
 * @method bool hasAllRoles(string|array $roles)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'password',
        'user_type',  // consider renaming to role_type if you want clearer semantics
        'gender',
        'vbu_id',
        'phone_verification_status',
        'phone_verified_at',
        'user_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
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

    // Relationship example (adjust if needed)


    // Scopes for new user roles — adjust or remove old ones
    public function scopeSuperAdministrators($query)
    {
        return $query->where('user_type', UserType::SUPER_ADMINISTRATOR);
    }

    public function scopeSystemAdministrators($query)
    {
        return $query->where('user_type', UserType::SYSTEM_ADMINISTRATOR);
    }

    public function scopeSeniorSpecialists($query)
    {
        return $query->where('user_type', UserType::IT_SENIOR_SPECIALIST);
    }

    public function scopeSpecialists($query)
    {
        return $query->where('user_type', UserType::IT_SPECIALIST);
    }

    public function scopeAssociates($query)
    {
        return $query->where('user_type', UserType::IT_ASSOCIATE);
    }

    public function scopeStandardUsers($query)
    {
        return $query->where('user_type', UserType::STANDARD_USER);
    }

    // Status scopes
    public function scopeActive($query)
    {
        return $query->where('user_status', UserStatus::ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('user_status', UserStatus::INACTIVE);
    }

    public function scopePhoneVerified($query)
    {
        return $query->where('phone_verification_status', UserEmailVerificationStatus::VERIFIED);
    }

    public function scopePhoneUnverified($query)
    {
        return $query->where('phone_verification_status', UserEmailVerificationStatus::UNVERIFIED);
    }

    // Accessors for labels

    public function getUserTypeLabelAttribute(): string
    {
        return UserType::label($this->user_type);
    }

    public function getUserStatusLabelAttribute(): string
    {
        return UserStatus::label($this->user_status);
    }
}
