<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Room
 *
 * @property int $id
 * @property int $apartment_id
 * @property string $type
 * @property-read \App\Models\Apartment|null $apartment
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereType($value)
 * @mixin \Eloquent
 */
class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function apartment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Apartment::class, 'apartment_id', 'id');
    }
}
