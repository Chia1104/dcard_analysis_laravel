<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Nlp extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'nlp_datas';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    use HasFactory;

    public function scopeMain($query)
    {
        return $query->select('Id', 'CreatedAt', 'SA_Score', 'SA_Class');
    }

    public function dcardRawData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\DcardRawData', 'Id', 'Id')->main();
    }
}
