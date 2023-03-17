<?php
namespace App\Traits;

trait HasRouteKey
{
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
