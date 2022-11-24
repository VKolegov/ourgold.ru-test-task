<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PieceOfFurniture
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type_code
 * @property int $apartment_id
 * @property int $room_id
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture query()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PieceOfFurniture extends Model
{
    use HasFactory;
}
