<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;

class Comparison extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comparison_datas';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    use HasFactory;

    public function scopeMain($query)
    {
        return $query->select('Id', 'CreatedAt', 'Level', 'KeywordLevel1', 'KeywordLevel2', 'KeywordLevel3')->orderByDesc('Id');
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->articles->filter(function ($item) {
                return $item->shouldBeSearchable();
            })->searchable();
        });
    }

    public function dcard(): HasMany
    {
        return $this->hasMany(Dcard::class, 'Id', 'Id');
    }
}
