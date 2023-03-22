<?php

namespace App\Models;

use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $uuid
 * @property string $category_uuid
 * @property string $title
 * @property float $price
 * @property array $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, SoftDeletes, HasUuid, HasRouteKey;

    protected $fillable = ['category_uuid','title','price', 'description', 'metadata'];

    protected $casts = [
        'metadata' => 'array'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_uuid', 'uuid');
    }

    public function scopeSortBy($query, $sortBy, $desc):mixed
    {
        $sortFields = [
            'id',
            'title',
            'price',
            'created_at',
        ];

        if (!in_array($sortBy, $sortFields)) {
            $sortBy = 'created_at';
        }

        return $query->orderBy($sortBy, $desc ? 'desc' : 'asc');
    }

    public function scopeLimitBy($query, $limit)
    {
        $limit = $limit ?: 50;
        return $query->limit(intval($limit));
    }

    public function scopeSearch($query, $searchQuery):mixed
    {
        if (!$searchQuery) {
            return $query;
        }

        return $query->where(function ($query) use ($searchQuery) {
            $query->where('first_name', 'like', "%$searchQuery%")
            ->orWhere('last_name', 'like', "%$searchQuery%")
            ->orWhere('email', 'like', "%$searchQuery%")
            ->orWhere('phone_number', 'like', "%$searchQuery%")
            ->orWhere('address', 'like', "%$searchQuery%")
            ->orWhereHas('category', function($query) use ($searchQuery) {
                $query->where('title', 'like', "%$searchQuery%");
            });
        });
    }

    /**
     * Search and sort the product record
     *
     * @param string $searchQuery
     * @param string $sortBy
     * @param string $desc
     * @param string $limit
     * @param string $perPage
     *
     * @return mixed
     */
    public static function searchAndSort($searchQuery, $sortBy, $desc, $limit, $perPage):mixed
    {
        return static::search($searchQuery)
            ->sortBy($sortBy, $desc)
            ->limitBy($limit)
            ->paginate($perPage);
    }
}
