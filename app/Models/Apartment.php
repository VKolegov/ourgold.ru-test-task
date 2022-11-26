<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Apartment
 *
 * @property int $id
 * @property int $number
 * @property int $number_of_rooms
 * @property string $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $rooms
 * @property-read int|null $rooms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PieceOfFurniture[] $furniture
 * @property-read int|null $furniture_count
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereNumberOfRooms($value)
 * @method static \Database\Factories\ApartmentFactory factory(...$parameters)
 * @mixin \Eloquent
 */
class Apartment extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function rooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Room::class, 'apartment_id', 'id');
    }

    public function furniture(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PieceOfFurniture::class, 'apartment_id', 'id');
    }
}
