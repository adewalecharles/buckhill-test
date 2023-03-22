<?php

namespace App\Models;

use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $uuid
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BrandFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Brand limitBy($limit)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand search($searchQuery)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand sortBy($sortBy, $desc)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUuid($value)
 * @mixin \Eloquent
 */
class Brand extends Model
{
    use HasFactory, HasUuid, HasRouteKey;

    protected $fillable = ['title', 'slug'];

    public function scopeSortBy($query, $sortBy, $desc)
    {
        $sortFields = [
            'id',
            'title',
            'created_at',
        ];

        if (! in_array($sortBy, $sortFields)) {
            $sortBy = 'created_at';
        }

        return $query->orderBy($sortBy, $desc ? 'desc' : 'asc');
    }

    public function scopeLimitBy($query, $limit)
    {
        $limit = $limit ?: 50;

        return $query->limit($limit);
    }

    public function scopeSearch($query, $searchQuery)
    {
        if (! $searchQuery) {
            return $query;
        }

        return $query->where(function ($query) use ($searchQuery) {
            $query->where('title', 'like', "%$searchQuery%")
            ->orWhere('slug', 'like', "%$searchQuery%");
        });
    }

    public static function searchAndSort($searchQuery, $sortBy, $desc, $limit, $perPage)
    {
        return static::search($searchQuery)
            ->sortBy($sortBy, $desc)
            ->limitBy($limit)
            ->paginate($perPage);
    }
}
