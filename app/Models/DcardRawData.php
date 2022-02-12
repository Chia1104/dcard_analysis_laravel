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
        return $query->select('Id', 'Title', 'CreatedAt', 'Content', 'Topics', 'Gender')->orderByDesc('Id');
    }

    public function nlp(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Nlp', 'Id', 'Id')
            ->select('Id', 'SA_Score', 'SA_Class');
    }

    public function comparison(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Comparison', 'Id', 'Id')
            ->select('Id', 'Level', 'KeywordLevel1', 'KeywordLevel2', 'KeywordLevel3');
    }

    /**
     * Get the index name for the model.
     */
    public function searchableAs(): string
    {
        return 'dcards_index';
    }
}
