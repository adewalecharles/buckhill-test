<?php
namespace App\Traits;

trait HasUuid
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = \Illuminate\Support\Str::uuid();
        });
    }
}
