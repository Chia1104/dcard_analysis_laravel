<?php

namespace App\Dcard\Services;

use App\Dcard\Repositories\NlpRepository;
use App\Models\Nlp;
use Carbon\Carbon;

class NlpService
{
    private NlpRepository $_nlpRepo;
    private Nlp $_nlp;

    public function __construct(NlpRepository $nlpRepo, Nlp $nlp) {
        $this -> _nlpRepo = $nlpRepo;
        $this -> _nlp = $nlp;
    }

    public function getTotalSAClass($date1, $date2): array
    {
        $saClass = array(0 => 'Positive', 1 => 'Neutral', 2 => 'Negative');
        $totalCount = array();
        for ($i = 0; $i < count($saClass); $i++) {
            $count = $this -> _nlpRepo
                ->getNlp()
                ->where('sa_class', $saClass[$i])
                ->whereBetween('created_at', array(
                    Carbon::createFromFormat('Y-m-d', $date1),
                    Carbon::createFromFormat('Y-m-d', $date2)
                ))
                ->count();
            $totalCount[] = array($saClass[$i] => $count);
        }
        $result['total'] = $totalCount;
        return $result;
    }

    public function getAvgSAScore()
    {
        return $this -> _nlp::raw(function($collection)
        {
            $date1 = Carbon::createFromFormat('Y-m-d', '2020-12-01');
            $date2 = Carbon::createFromFormat('Y-m-d', '2021-11-30');
            $ISODate1 = 'ISODate("2020-12-01")';
            $ISODate2 = 'ISODate("2021-11-30")';
            return $collection->aggregate([
//                [
//                    '$match' => [
//                        'created_at' => [
//                            '$gte' => $date1,
//                            '$lte' => $date2,
//                        ]
//                    ]
//                ],
                [
                    '$group' => [
                        '_id' => [
                            '$dateToString' => [
                                'format' => '%Y-%m',
                                'date' => '$created_at'
                            ]
                        ],
                        'avg_score' => [
                            '$avg' => '$sa_score',
                        ],
                    ]
                ],
                [
                    '$sort' => [
                        '_id' => -1
                    ],
                ],
            ]);
        });
    }
}
