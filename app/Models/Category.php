<?php

namespace App\Models;

use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuid, HasRouteKey;

    protected $fillable = ['title', 'slug'];
}
