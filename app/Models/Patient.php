<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public static string $cacheKey = 'patients';

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::updated(fn() => Cache::forget(self::$cacheKey));
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
