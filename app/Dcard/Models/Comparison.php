<?php

namespace App\Dcard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;

class Comparison extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comparison_datas';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $dates = ['created_at'];
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->dcard->filter(function ($item) {
                return $item->shouldBeSearchable();
            })->searchable();
        });
    }

    public function dcard(): HasMany
    {
        return $this->hasMany(Dcard::class, 'id', 'id');
    }
}
