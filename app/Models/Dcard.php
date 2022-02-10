<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dcard extends Model
{
    protected $table = 'dcard_rawdata';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    use HasFactory;

    public function scopeMain($query)
    {
        return $query->select('Id', 'Title', 'CreatedAt', 'Content');
    }

    public function nlp() {
        return $this->belongsTo('App\Models\Nlp', 'Id');
    }

    public function comparison() {
        return $this->hasOne('App\Models\Comparison', 'Id');
    }
}
