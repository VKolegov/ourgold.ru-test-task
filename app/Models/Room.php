<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Room
 *
 * @property int $id
 * @property int $apartment_id
 * @property string $type_code
 * @property-read \App\Models\Apartment|null $apartment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PieceOfFurniture[] $furniture
 * @property-read int|null $furniture_count
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereTypeCode($value)
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

    public function furniture(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PieceOfFurniture::class, 'room_id', 'id');
    }
}
