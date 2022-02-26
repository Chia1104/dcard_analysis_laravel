<?php

namespace App\Dcard\Repositories;

use App\Models\Dcard;
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
            ->select('id', 'title', 'date_time', 'created_at', 'content', 'topics', 'tags', 'gender')
            ->orderByDesc('id');
    }

    public function getDcardById($id): Builder
    {
        return $this -> _dcard::with(['nlp', 'comparison'])
            ->select('id', 'title', 'date_time', 'created_at', 'content', 'topics', 'tags', 'gender')
            ->whereIn('id', [$id]);
    }

    public function searchDcards($search): \Laravel\Scout\Builder
    {
        return $this -> _dcard::search($search);
    }

    public function getDateBetween($date1, $date2): Builder
    {
        return $this -> _dcard::with(['nlp', 'comparison'])
            ->select('id', 'title', 'date_time', 'created_at', 'content', 'topics', 'tags', 'gender')
            ->whereBetween('created_at', array(
                Carbon::createFromFormat('Y-m-d', $date1),
                Carbon::createFromFormat('Y-m-d', $date2)
            ))
            ->orderByDesc('id');
    }
}
