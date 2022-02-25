<?php

namespace App\Dcard\Services;

use App\Dcard\Repositories\DcardRepository;
use Illuminate\Database\Eloquent\Builder;

class DcardService
{
    private DcardRepository $_dcardRepo;

    public function __construct(DcardRepository $dcardRepo) {
        $this -> _dcardRepo = $dcardRepo;
    }

    public function getAllDcards(): Builder
    {
        return $this -> _dcardRepo -> getAllDcards();
    }

    public function getDcardById($id): Builder
    {
        return $this -> _dcardRepo -> getDcardById($id);
    }

    public function searchDcards($search): \Laravel\Scout\Builder
    {
        return $this -> _dcardRepo -> searchDcards($search);
    }

    public function getDateBetween($date1, $date2): Builder
    {
        return $this -> _dcardRepo -> getDateBetween($date1, $date2);
    }

    public function getDateDcards($type): Builder
    {
        switch ($type) {
            case 'week':
                return $this -> _dcardRepo -> getDateBetween('2021-11-07', '2021-11-13');
            case 'month':
                return $this -> _dcardRepo -> getDateBetween('2021-11-01', '2021-11-30');
            case 'today':
            default:
                return $this -> _dcardRepo -> getDateBetween('2021-11-09', '2021-11-10');
        }
    }

    public function getMaxScoreDcard($date1, $date2): Builder
    {
        return $this -> _dcardRepo -> getDateBetween($date1, $date2) -> max('nlp.sa_score');
    }
}
