<?php

namespace App\Dcard\Services;

use App\Dcard\Repositories\DcardRepository;
use App\Dcard\Services\NlpService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class DcardService
{
    private DcardRepository $_dcardRepo;
    private NlpService $_nlpService;

    public function __construct(DcardRepository $dcardRepo, NlpService $nlpService) {
        $this -> _dcardRepo = $dcardRepo;
        $this -> _nlpService = $nlpService;
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
        return match ($type) {
            'week' => $this->_dcardRepo->getDateBetween('2021-11-07', '2021-11-13'),
            'month' => $this->_dcardRepo->getDateBetween('2021-11-01', '2021-11-30'),
            default => $this->_dcardRepo->getDateBetween('2021-11-09', '2021-11-10'),
        };
    }

    public function getMaxScoreDcard($date1, $date2): Collection|array
    {
        $maxScore = $this -> _nlpService ->getMaxSAScore($date1, $date2);
        $dcards = $this -> _dcardRepo -> getDateBetween($date1, $date2) -> get();
        return $dcards->where('nlp.sa_score', '=', $maxScore);
    }

    public function getMinScoreDcard($date1, $date2): Collection|array
    {
        $minScore = $this -> _nlpService ->getMinSAScore($date1, $date2);
        $dcards = $this -> _dcardRepo -> getDateBetween($date1, $date2) -> get();
        return $dcards->where('nlp.sa_score', '=', $minScore);
    }
}
