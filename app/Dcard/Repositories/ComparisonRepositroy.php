<?php

namespace App\Dcard\Repositories;

use App\Dcard\Models\Comparison;

class ComparisonRepositroy
{
    private Comparison $_comparison;

    public function __construct(Comparison $comparison) {
        $this -> _comparison = $comparison;
    }

    public function getMain() {
        $comparison = $this -> _comparison
            ->select('id', 'level', 'keyword_level1', 'keyword_level2', 'keyword_level3')
            ->orderByDesc('id');
        return $comparison->dcards;
    }
}
