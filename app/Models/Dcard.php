<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Dcard extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'dcards';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    /**
     * @var mixed
     */
    use HasFactory, Searchable;

    public function scopeMain($query)
    {
        return $query->select('Id', 'Title', 'CreatedAt', 'Content', 'Topics', 'Tags', 'Gender')->orderByDesc('Id');
    }

    protected $touches = ['nlp'];
    public function nlp(): BelongsTo
    {
        return $this->belongsTo(Nlp::class, 'Id', 'Id')
            ->select('Id', 'SA_Score', 'SA_Class');
    }

    public function comparison(): BelongsTo
    {
        return $this->belongsTo(Comparison::class, 'Id', 'Id')
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
