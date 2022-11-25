<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PieceOfFurnitureHistoryEntry
 *
 * @property int $piece_of_furniture_id
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $apartment_id
 * @property int|null $room_id
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry wherePieceOfFurnitureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry whereRoomId($value)
 * @mixin \Eloquent
 */
class PieceOfFurnitureHistoryEntry extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['date', 'apartment_id', 'room_id'];

    protected $dates = [
        'date'
    ];
}
