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
            ->select('Id', 'Level', 'KeywordLevel1', 'KeywordLevel2', 'KeywordLevel3')
            ->orderByDesc('Id');
        return $comparison->dcards;
    }
}
