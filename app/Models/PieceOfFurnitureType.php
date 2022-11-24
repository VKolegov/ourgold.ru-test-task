<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PieceOfFurnitureType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PieceOfFurniture[] $furniture
 * @property-read int|null $furniture_count
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureType whereName($value)
 * @mixin \Eloquent
 */
class PieceOfFurnitureType extends Model
{
    use HasFactory;

    public function furniture(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PieceOfFurniture::class, 'type_code', 'code');
    }
}
