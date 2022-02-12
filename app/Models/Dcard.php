<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dcard extends Model
{
    use HasFactory;

    public function scopeMain()
    {
        return DB::table('dcard_rawdata')
            ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
            ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
            ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
            ->orderByDesc('dcard_rawdata.Id');
    }
}
