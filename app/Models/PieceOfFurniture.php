<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PieceOfFurniture
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type_code
 * @property int $apartment_id
 * @property int $room_id
 * @property string $material_code
 * @property string $color_code
 * @property-read \App\Models\PieceOfFurnitureType $type
 * @property-read \App\Models\Apartment $apartment
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Material $material
 * @property-read \App\Models\Color $color
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PieceOfFurnitureHistoryEntry[] $history
 * @property-read int|null $history_count
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture query()
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereMaterialCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereColorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PieceOfFurniture whereUpdatedAt($value)
 * @method static \Database\Factories\PieceOfFurnitureFactory factory(...$parameters)
 * @mixin \Eloquent
 */
class PieceOfFurniture extends Model
{
    use HasFactory;

    protected $table = 'pieces_of_furniture';
    protected $fillable = ['room_id', 'apartment_id'];

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function apartment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Apartment::class, 'apartment_id', 'id');
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PieceOfFurnitureType::class, 'type_code', 'code');
    }

    public function material(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_code', 'code');
    }

    public function color(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_code', 'code');
    }

    public function history(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PieceOfFurnitureHistoryEntry::class, 'piece_of_furniture_id', 'id')
            ->orderBy('placed_at', 'desc')->orderBy('id', 'desc');
    }
}
