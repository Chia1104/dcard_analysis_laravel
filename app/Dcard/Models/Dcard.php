<?php

namespace App\Dcard\Models;

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
    protected $dates = ['CreatedAt', 'UpdatedAt'];

    use HasFactory, Searchable;

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

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array = $this->transform($array);

        $array['SA_Score'] = $this->nlp ? $this->nlp->SA_Score : '';
        $array['SA_Class'] = $this->nlp ? $this->nlp->SA_Class : '';
        $array['Level'] = $this->comparison ? $this->comparison->Level : '';
        $array['KeywordLevel1'] = $this->comparison ? $this->comparison->KeywordLevel1 : '';
        $array['KeywordLevel2'] = $this->comparison ? $this->comparison->KeywordLevel2 : '';
        $array['KeywordLevel3'] = $this->comparison ? $this->comparison->KeywordLevel3 : '';

        return $array;
    }
}
