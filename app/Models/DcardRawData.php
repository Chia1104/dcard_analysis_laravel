<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcardRawData extends Model
{
    protected $table = 'dcard_rawdata';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    use HasFactory, Searchable;

    public function scopeMain($query)
    {
        return $query->select('Id', 'Title', 'CreatedAt', 'Content');
    }

    /**
     * Get the index name for the model.
     */
    public function searchableAs()
    {
        return 'dcards_index';
    }
}
