<?php

namespace App\Dcard\Services;

use App\Dcard\Repositories\NlpRepository;
use App\Dcard\Models\Nlp;
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
        $saclass = array(0 => 'Positive', 1 => 'Neutral', 2 => 'Negative');
        $pdatas = array();
        for ($i = 0; $i < count($saclass); $i++) {
            $count = $this -> _nlpRepo
                -> getNlp()
                ->where('SA_Class', $saclass[$i])
                ->whereBetween('CreatedAt', array(
                    Carbon::createFromFormat('Y-m-d', $date1),
                    Carbon::createFromFormat('Y-m-d', $date2)
                ))
                ->count();
            $pdatas[] = array($saclass[$i] => $count);
        }
        $result['total'] = $pdatas;
        return $result;
    }

    public function getAvgSAScore()
    {
        return $this -> _nlp::raw(function($collection)
        {
            return $collection->aggregate([
//                [
//                    '$match' => [
//                        'CreatedAt' => [
//                            '$gte' => Carbon::createFromFormat('Y-m', '2020-12'),
//                            '$lte' => Carbon::createFromFormat('Y-m', '2021-11'),
//                        ]
//                    ]
//                ],
                [
                    '$group' => [
                        '_id' => [
                            '$dateToString' => [
                                'format' => '%Y-%m',
                                'date' => '$CreatedAt'
                            ]
                        ],
                        'avg_score' => [
                            '$avg' => '$SA_Score',
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
