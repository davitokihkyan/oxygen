<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $patient_id
 * @property string $name
 * @property float $price
 * @property Carbon $date
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property bool $active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Appointment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    protected $fillable = [
        'patient_id',
        'name',
        'price',
        'date',
        'start_time',
        'end_time',
        'active'
    ];

    /**
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
