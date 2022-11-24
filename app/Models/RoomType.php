<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoomType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomType whereName($value)
 * @mixin \Eloquent
 */
class RoomType extends Model
{
    use HasFactory;
}
