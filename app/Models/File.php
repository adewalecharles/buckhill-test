<?php

namespace App\Models;

use App\Traits\HasRouteKey;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, HasUuid, HasRouteKey;

    protected $fillable = ['name', 'path', 'size', 'type'];
}
