<?php

namespace App\Models;

use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $path
 * @property string $size
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUuid($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    use HasFactory, HasUuid, HasRouteKey;

    protected $fillable = ['name', 'path', 'size', 'type'];
}
