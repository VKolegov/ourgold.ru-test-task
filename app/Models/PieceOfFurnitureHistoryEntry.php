<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PieceOfFurnitureHistoryEntry
 *
 * @property int $id
 * @property int $piece_of_furniture_id
 * @property \Illuminate\Support\Carbon $placed_at
 * @property \Illuminate\Support\Carbon|null $removed_at
 * @property int|null $apartment_id
 * @property int|null $room_id
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry wherePieceOfFurnitureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry wherePlacedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry whereRemovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurnitureHistoryEntry whereRoomId($value)
 * @mixin \Eloquent
 */
class PieceOfFurnitureHistoryEntry extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['placed_at', 'removed_at', 'apartment_id', 'room_id'];

    protected $dates = [
        'placed_at', 'removed_at'
    ];
}
