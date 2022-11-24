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
}
