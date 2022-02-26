<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;

class Nlp extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'nlp_datas';
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
