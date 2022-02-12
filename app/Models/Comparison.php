<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    protected $table = 'comparison';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    use HasFactory;

    public function scopeMain($query)
    {
        return $query->select('Id', 'CreatedAt', 'Level', 'KeywordLevel1', 'KeywordLevel2', 'KeywordLevel3');
    }

    public function dcardRawData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\DcardRawData', 'Id', 'Id');
    }
}
