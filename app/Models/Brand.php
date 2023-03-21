<?php

namespace App\Models;

use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

        if (!in_array($sortBy, $sortFields)) {
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
        if (!$searchQuery) {
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
