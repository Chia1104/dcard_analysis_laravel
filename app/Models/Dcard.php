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
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $dates = ['created_at', 'updated_at'];

    use HasFactory, Searchable;

    public function nlp(): BelongsTo
    {
        return $this->belongsTo(Nlp::class, 'id', 'id')
            ->select('id', 'sa_score', 'sa_class');
    }

    public function comparison(): BelongsTo
    {
        return $this->belongsTo(Comparison::class, 'id', 'id')
            ->select('id', 'level', 'keyword_level1', 'keyword_level2', 'keyword_level3');
    }

    /**
     * Get the index name for the model.
     */
    public function searchableAs(): string
    {
        return 'dcards_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array = $this->transform($array);

        $array['sa_score'] = $this->nlp ? $this->nlp->sa_score : '';
        $array['sa_class'] = $this->nlp ? $this->nlp->sa_class : '';
        $array['level'] = $this->comparison ? $this->comparison->level : '';
        $array['keyword_level1'] = $this->comparison ? $this->comparison->keyword_level1 : '';
        $array['keyword_level2'] = $this->comparison ? $this->comparison->keyword_level2 : '';
        $array['keyword_level3'] = $this->comparison ? $this->comparison->keyword_level3 : '';

        return $array;
    }
}
