<?php

namespace App\Dcard\Repositories;

use App\Dcard\Models\Dcard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DcardRepository
{
    private Dcard $_dcard;

    public function __construct(Dcard $dcard) {
        $this -> _dcard = $dcard;
    }

    public function getAllDcards(): Builder
    {
        return $this -> _dcard::with(['nlp', 'comparison'])
            ->select('Id', 'Title', 'DateTime', 'CreatedAt', 'Content', 'Topics', 'Tags', 'Gender')
            ->orderByDesc('Id');
    }

    public function getDcardById($id): Builder
    {
        return $this -> _dcard::with(['nlp', 'comparison'])
            ->select('Id', 'Title', 'DateTime', 'CreatedAt', 'Content', 'Topics', 'Tags', 'Gender')
            ->whereIn('Id', [$id]);
    }

    public function searchDcards($search): \Laravel\Scout\Builder
    {
        return $this -> _dcard::search($search);
    }

    public function getDateBetween($date1, $date2): Builder
    {
        return $this -> _dcard::with(['nlp', 'comparison'])
            ->select('Id', 'Title', 'DateTime', 'CreatedAt', 'Content', 'Topics', 'Tags', 'Gender')
            ->whereBetween('CreatedAt', array(
                Carbon::createFromFormat('Y-m-d', $date1),
                Carbon::createFromFormat('Y-m-d', $date2)
            ))
            ->orderByDesc('Id');
    }
}
