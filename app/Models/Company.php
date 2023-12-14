<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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
class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'color',
        'active',
        'created_at',
        'updated_at'
    ];

    public static string $cacheKey = 'companies';

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::updated(fn() => Cache::forget(self::$cacheKey));
    }

    /**
     * @return HasMany
     */
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class, 'company_id');
    }
}
