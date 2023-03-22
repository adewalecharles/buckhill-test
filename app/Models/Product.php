<?php

namespace App\Models;

use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
