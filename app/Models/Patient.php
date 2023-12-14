<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

/**
 * @property string $id
 * @property string $name
 * @property string $color
 * @property bool $active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Patient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patients';

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'address',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'name_w_count'
    ];

    public static string $cacheKey = 'patients';

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(fn() => Cache::forget(self::$cacheKey));
        static::updated(fn() => Cache::forget(self::$cacheKey));
        static::deleted(fn() => Cache::forget(self::$cacheKey));
    }

    /**
     * @return string
     */
    public function getNameWCountAttribute(): string
    {
        if ($this->appointments_count) {
            return $this->name . ' (' . $this->appointments_count . ')';
        } else {
            return $this->name;
        }
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
