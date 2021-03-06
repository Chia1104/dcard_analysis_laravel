<?php

namespace App\Dcard\Services;

use App\Dcard\Repositories\NlpRepository;
use App\Models\Nlp;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class NlpService
{
    private NlpRepository $_nlpRepo;
    private Nlp $_nlp;

    public function __construct(NlpRepository $nlpRepo, Nlp $nlp)
    {
        $this->_nlpRepo = $nlpRepo;
        $this->_nlp = $nlp;
    }

    public function getTotalSAClass($date1, $date2): array
    {
        $saClass = [0 => 'Positive', 1 => 'Neutral', 2 => 'Negative'];
        $totalCount = [];
        for ($i = 0; $i < count($saClass); $i++) {
            $count = $this->_nlpRepo
                ->getDateBetween($date1, $date2)
                ->where('sa_class', $saClass[$i])
                ->count();
            $totalCount[] = [$saClass[$i] => $count];
        }
        $result['total'] = $totalCount;

        return $result;
    }

    public function getMaxSAScore($date1, $date2)
    {
        return $this->_nlpRepo
            ->getDateBetween($date1, $date2)
            ->max('sa_score');
    }

    public function getMinSAScore($date1, $date2)
    {
        return $this->_nlpRepo
            ->getDateBetween($date1, $date2)
            ->min('sa_score');
    }

    public function getAvgSAScore($type, $date1, $date2)
    {
        $firstDate = $date1;
        $secondDate = $date2;

        return match ($type) {
            'day' => $this->_nlp::raw(function ($collection) use ($firstDate, $secondDate) {
                $firstDate = new UTCDateTime(Carbon::createFromFormat('Y-m-d', $firstDate)->timestamp * 1000);
                $secondDate = new UTCDateTime(Carbon::createFromFormat('Y-m-d', $secondDate)->timestamp * 1000);

                return $collection->aggregate([
                    [
                        '$match' => [
                            'created_at' => [
                                '$gte' => $firstDate,
                                '$lte' => $secondDate,
                            ],
                        ],
                    ],
                    [
                        '$group' => [
                            '_id' => [
                                'year' => [
                                    '$year' => '$created_at',
                                ],
                                'month' => [
                                    '$month' => '$created_at',
                                ],
                                'day' => [
                                    '$dayOfMonth' => '$created_at',
                                ],
                            ],
                            'avg_score' => [
                                '$avg' => '$sa_score',
                            ],
                        ],
                    ],
                    [
                        '$sort' => [
                            '_id' => -1,
                        ],
                    ],
                ]);
            }),
            'week' => $this->_nlp::raw(function ($collection) use ($firstDate, $secondDate) {
                $firstDate = new UTCDateTime(Carbon::createFromFormat('Y-m-d', $firstDate)->timestamp * 1000);
                $secondDate = new UTCDateTime(Carbon::createFromFormat('Y-m-d', $secondDate)->timestamp * 1000);

                return $collection->aggregate([
                    [
                        '$match' => [
                            'created_at' => [
                                '$gte' => $firstDate,
                                '$lte' => $secondDate,
                            ],
                        ],
                    ],
                    [
                        '$group' => [
                            '_id' => [
                                'year' => [
                                    '$year' => '$created_at',
                                ],
                                'week' => [
                                    '$week' => '$created_at',
                                ],
                            ],
                            'avg_score' => [
                                '$avg' => '$sa_score',
                            ],
                        ],
                    ],
                    [
                        '$sort' => [
                            '_id' => -1,
                        ],
                    ],
                ]);
            }),
            default => $this->_nlp::raw(
                function ($collection) use ($firstDate, $secondDate) {
                    $firstDate = new UTCDateTime(Carbon::createFromFormat('Y-m', $firstDate)->timestamp * 1000);
                    $secondDate = new UTCDateTime(Carbon::createFromFormat('Y-m', $secondDate)->timestamp * 1000);

                    return $collection->aggregate([
                        [
                            '$match' => [
                                'created_at' => [
                                    '$gte' => $firstDate,
                                    '$lte' => $secondDate,
                                ],
                            ],
                        ],
                        [
                            '$group' => [
                                '_id' => [
                                    'year' => [
                                        '$year' => '$created_at',
                                    ],
                                    'month' => [
                                        '$month' => '$created_at',
                                    ],
                                ],
                                'avg_score' => [
                                    '$avg' => '$sa_score',
                                ],
                            ],
                        ],
                        [
                            '$sort' => [
                                '_id' => -1,
                            ],
                        ],
                    ]);
                }
            ),
        };
    }
}
