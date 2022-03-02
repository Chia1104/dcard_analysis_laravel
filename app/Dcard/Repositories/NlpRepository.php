<?php

namespace App\Dcard\Repositories;

use App\Models\Nlp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class NlpRepository
{
    private Nlp $_nlp;

    public function __construct(Nlp $nlp) {
        $this -> _nlp = $nlp;
    }

    public function getNlp() {
        return $this -> _nlp
            ->select('id', 'sa_score', 'sa_class')
            ->orderByDesc('id');
    }

    public function getDateBetween($date1, $date2): Builder
    {
        return $this -> _nlp
            ->select('id', 'created_at', 'sa_score', 'sa_class')
            ->whereBetween('created_at', array(
                Carbon::createFromFormat('Y-m-d', $date1),
                Carbon::createFromFormat('Y-m-d', $date2)
            ))
            ->orderByDesc('id');
    }
}
