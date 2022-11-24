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
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Apartment whereNumberOfRooms($value)
 * @mixin \Eloquent
 */
class Apartment extends Model
{
    use HasFactory;

    public $timestamps = false;
}